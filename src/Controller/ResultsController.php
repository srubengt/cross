<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * Results Controller
 *
 * @property \App\Model\Table\ResultsTable $Results
 */
class ResultsController extends AppController
{

    public $times_set = [15, 30, 60, 90, 120, 180];

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $search = '';

        $this->paginate = [
            'contain' => ['Exercises']
        ];
        $results = $this->paginate($this->Results);

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

    public function search(){
        $this->autoRender = false;

        $result = $this->Results->newEntity();

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


    public function add($id = null) //id Exercise
    {
        $result = $this->Results->newEntity();
        if ($this->request->is('post')) {

            $data = [
                'user_id' => $this->Auth->user('id'),
                'exercise_id' => $id,
                'date' => new Time()
            ];

            $result = $this->Results->patchEntity($result, $data);

            if ($this->Results->save($result)) {
                $this->Flash->success(__('Saved.'));
                return $this->redirect(['action' => 'edit', $result->id]);
            } else {
                $this->Flash->error(__('Error. Please, try again.'));
            }
        }

        //Variables a enviar

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
            'contain' => ['Exercises']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $result = $this->Results->patchEntity($result, $this->request->data);
            if ($this->Results->save($result)) {
                $this->Flash->success(__('Saved.'));
                return $this->redirect(['action' => 'edit', $result->id]);
            } else {
                $this->Flash->error(__('The result could not be saved. Please, try again.'));
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
        $this->set('_serialize', ['result']);
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
}
