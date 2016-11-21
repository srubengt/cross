<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Utility\Hash;

/**
 * Results Controller
 *
 * @property \App\Model\Table\ResultsTable $Results
 */
class ResultsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $search = '';

        $results = $this->Results->find('all',[
            'contain' => [
                'Exercises',
                'Sets',
                'Sets.Details'
            ]
        ])
                ->where(['Results.user_id' => $this->Auth->user('id')]) //Resultados del Usuario Logged.
                ->order(['Results.date' => 'desc', 'Results.created' => 'desc']) //De actual a más antiguo.
        ;

        //Enviamos todos los ejercicios con resultados asociados
        $exercises = $this->Results->find('all',[
           'contain' => 'Exercises'
        ])
            ->where(['Results.user_id' => $this->Auth->user('id') ])
            ->distinct(['Exercises.id'])
            ->order(['Exercises.name']);


        if ($this->request->is('post')) {
            $search = $this->request->data['search'];
            if ($search) {
                $exercises
                    ->where(['Exercises.name LIKE' => '%' . $search . '%'])
                ;
            }
        }

        $this->set('scores', $this->scores);
        $this->set('times_set', $this->times_set);
        $this->set(compact('results', 'exercises', 'search'));
    }

    /**
     * View method
     *
     * @param string|null $id Result id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        $result = $this->Results->get($id, [
            'contain' => ['SessionsUsers', 'Exercises']
        ]);

        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }


    //Sección ADD Ejercicio
    public function search(){
        $this->autoRender = false;
        $result = $this->Results->newEntity();

        //score
        //$score = $this->request->query['score'];

        //back: results/index
        $back = [
            'controller' => 'results',
            'action' => 'index',
            'val' => ''
        ];

        $search = '';

        //Enviamos todos los ejercicios
        $exercises = $this->Results->Exercises->find('all',[
            'contain' => 'Groups'
        ])
            ->order(['Exercises.name']);

        if ($this->request->is('post')) {
            $search = $this->request->data['search'];
            if ($search) {
                $exercises
                    ->where(['Exercises.name LIKE' => '%' . $search . '%'])
                ;
            }
        }

        $this->set(compact('result', 'exercises', 'back', 'search'));
        $this->render('add');
    }


    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */

    public function score(){

        if (!$this->request->query['id']){
            $this->Flash->error(__('Error. Please, try again.'));
            return $this->redirect(['action' => 'index']);
        }

        $id = $this->request->query['id'];
        $exercise = $this->Results->Exercises->get($id);

        $temp = [];
        foreach (array_keys($this->scores) as $key){
            if ($exercise[$key]){
                $temp[$key] = $this->scores[$key];
            }
        }


        $this->set('exercise', $exercise);
        $this->set('scores', $temp);
    }


    public function add($id = null) //id Exercise
    {
        $result = $this->Results->newEntity();
        if ($this->request->is('post')) {
            /*if (empty($this->request->query['score'])){ //Si no se envía la variable score implica Error
                $this->Flash->error(__('Error. Please, try again.'));
                return $this->redirect(['action' => 'index']);
            }else{
                $score = $this->request->query['score'];
            }*/

            $data = [
                'user_id' => $this->Auth->user('id'),
                'exercise_id' => $this->request->data['exercise_id'],
                'date' => new Time(),
                'score' => $this->request->data['score']
            ];

            $result = $this->Results->patchEntity($result, $data);

            if ($this->Results->save($result)) {
                $this->Flash->success(__('Saved.'));
                return $this->redirect(['action' => 'edit', $result->id]);
            } else {
                $this->Flash->error(__('Error. Please, try again.'));
            }
        }

        //VARIABLES

        //back: results/index
        $back = [
            'controller' => 'results',
            'action' => 'index',
            'val' => ''
        ];

        $search = '';

        //Enviamos todos los ejercicios según la variable score
        $exercises = $this->Results->Exercises->find('all',[
            'contain' => 'Groups'
        ])
            ->order(['Exercises.name']);

        //$this->set('score', $score);
        $this->set(compact('result', 'exercises', 'back', 'search'));
        $this->set('_serialize', ['result']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Result id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) //id Result
    {
        $result = $this->Results->get($id, [
            'contain' => ['Exercises', 'Exercises.Details', 'Sets', 'Sets.Details']
        ]);


        if ($this->request->is(['patch', 'post', 'put'])){

            if ($this->request->is(['ajax'])){
                //si el cambio es ajax
                $this->autoRender=false;

                if (Hash::check($this->request->data, 'date')){
                    $this->request->data['date'] = new Time($this->request->data['date']);
                }
                $result = $this->Results->patchEntity($result, $this->request->data);
                if ($this->Results->save($result)) {
                    echo "Success: data saved";
                } else {
                    echo "Error: some error";
                }

            }else {
                $result = $this->Results->patchEntity($result, $this->request->data);

                if ($this->Results->save($result)) {
                    $this->Flash->success(__('Saved.'));
                    return $this->redirect(['action' => 'edit', $result->id]);
                } else {
                    debug($result);
                    die();
                    $this->Flash->error(__('The result could not be saved. Please, try again.'));
                }
            }
        }

        //back: results/index
        $back = [
            'controller' => 'results',
            'action' => 'index',
            'val' => ''
        ];

        $this->set('back', $back);
        $this->set('times_set', $this->times_set);
        $this->set(compact('result'));
        $this->set('_serialize', ['result', 'set']);
    }


    function history($id = null){
        //Function que muestra un resumen de resultados del ejercicio seleccionado.
        if ($this->request->is('post')){
            $score_search = $this->request->data('score');
        }else{
            $score_search =  null;
        }

        //Datos del ejercicio
        $exercise = $this->Results->Exercises->get($id,[
            'contain' => ['Groups']
        ]);

        //Scores seleccion
        $temp = [];
        foreach (array_keys($this->scores) as $key){
            if ($exercise[$key]){
                $temp[$key] = $this->scores[$key];
            }
        }

        //Resultados obtenidos del ejercicio
        $results = $this->Results->find('all',[
            'contain' => ['Sets', 'Sets.Details']
        ])->where(
            [
                'Results.exercise_id' => $id,
                'Results.user_id' => $this->Auth->user('id')
            ]
        );

        //Filtramos si existe valor en score_search
        if (!empty($score_search)){
            $results->where([
                'Results.score' => $score_search
            ]);
        }


        //back: results/index
        $back = [
            'controller' => 'results',
            'action' => 'index',
            'options' => [ //variables en query
                'tab' => 1
            ]
        ];

        $this->set('times_set', $this->times_set);
        $this->set('back', $back);
        $this->set('scores', $temp);
        $this->set('results', $results);
        $this->set('exercise', $exercise);
    }


    /**
     * Delete method
     *
     * @param string|null $id Result id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $result = $this->Results->get($id);
        if ($this->Results->delete($result)) {
            $this->Flash->success(__('The result has been deleted.'));
        } else {
            $this->Flash->error(__('The result could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function changeDate(){
        $this->set('fecha', $this->request->data('fecha'));
    }

}
