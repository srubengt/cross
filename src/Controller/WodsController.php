<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\ExercisesWodsTable;
use Cake\Utility\Hash;

/**
 * Wods Controller
 *
 * @property \App\Model\Table\WodsTable $Wods
 */
class WodsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $search = '';
        $this->paginate = [
            'order' => ['Wods.created' => 'asc'],
        ];

        $query = $this->Wods->find();
        if ($this->request->is('post')) {
            $search = $this->request->data['search'];
            if ($search) {
                $query->where(['Wods.name LIKE' => '%' . $search . '%']);
            }
        }

        $wods = $this->paginate($query);


        $this->set('title', 'Wods');
        $this->set('small', 'List');


        $this->set('search', $search);
        $this->set(compact('wods'));
        $this->set('_serialize', ['wods']);
    }

    /**
     * View method
     *
     * @param string|null $id Wod id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $wod = $this->Wods->get($id, [
            'contain' => ['Workouts']
        ]);

        $back = [
            'controller' => 'wods',
            'action' => 'index',
            'val' => ''
        ];


        $this->set('title', 'Wods');
        $this->set('small', 'View');

        $this->set('back', $back);

        $this->set('wod', $wod);
        $this->set('_serialize', ['wod']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $wod = $this->Wods->newEntity();

        if ($this->request->is('post')) {
            $wod = $this->Wods->patchEntity($wod, $this->request->data);
            if ($this->Wods->save($wod)) {
                $this->Flash->success(__('The wod has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The wod could not be saved. Please, try again.'));
            }
        }
        //$exercises = $this->Wods->Exercises->find('list', ['limit' => 200]);
        $workouts = $this->Wods->Workouts->find('list', ['limit' => 200]);

        $back = [
            'controller' => 'wods',
            'action' => 'index',
            'val' => ''
        ];


        $this->set('title', 'Wods');
        $this->set('small', 'Add');

        $this->set('back', $back);

        $this->set(compact('wod', 'workouts'));
        $this->set('_serialize', ['wod']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Wod id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $wod = $this->Wods->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $wod = $this->Wods->patchEntity($wod, $this->request->data);
            if ($this->Wods->save($wod)) {
                $this->Flash->success(__('The wod has been saved.'));
                return $this->redirect(['action' => 'edit', $id]);
            } else {
                $this->Flash->error(__('The wod could not be saved. Please, try again.'));
            }
        }

        $back = [
            'controller' => 'wods',
            'action' => 'index',
            'val' => ''
        ];


        $this->set('title', 'Wods');
        $this->set('small', 'Edit');

        $this->set('back', $back);

        $this->set(compact('wod', 'workouts'));
        $this->set('_serialize', ['wod']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Wod id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        //Comprobamos si existe el param date. True => Rederigimos a Reservations->index | False => Wods -> index
        $wod = $this->Wods->get($id);

        if ($this->Wods->delete($wod)) {
            $this->Flash->success(__('The wod has been deleted.'));
        } else {
            $this->Flash->error(__('The wod could not be deleted. Please, try again.'));
        }

        if ($this->request->query){ //Se han pasado parámetros por query
            if (Hash::check($this->request->query, 'date')){
                return $this->redirect(['controller'=> 'reservations', 'action' => 'index', 'date'=> $this->request->query['date']]);
            }else{
                return $this->redirect(['action' => 'index']);
            }
        }else{
            return $this->redirect(['action' => 'index']);
        }
    }

    public function deleteImage($id = null){

        // Deleting the upload?
        $wod = $this->Wods->get($id);

        $this->request->data['photo_dir'] = null;
        $this->request->data['photo'] = null;

        $path = new \Proffer\Lib\ProfferPath($this->Wods, $wod, 'photo', $this->Wods->behaviors()->Proffer->config('photo'));

        $wod = $this->Wods->patchEntity($wod, $this->request->data);
        if ($this->Wods->save($wod)) {
            $path->deleteFiles($path->getFolder(), true);
            $this->Flash->success(__('The image has been deleted.'));
            return $this->redirect(['action' => 'edit', $id]);
        } else {
            $this->Flash->error(__('The image could not be saved. Please, try again.'));
        }

        return $this->redirect(['action' => 'edit', $id]);

    }


    public function deleteExercise($wod_id = null, $exercise_id = null)
    {

        $this->request->allowMethod(['post', 'delete']);

        $ew = $this->Wods->ExercisesWods
                ->find()
                ->where(['ExercisesWods.wod_id' => $wod_id, 'ExercisesWods.exercise_id' => $exercise_id])
                ->toArray()
            ;

        $ew_id = $ew[0]['id'];

        $exercise = $this->Wods->ExercisesWods->get($ew_id);

        if ($this->Wods->ExercisesWods->delete($exercise)) {
            $this->Flash->success(__('The Exercise has been deleted.'));
        } else {
            $this->Flash->error(__('The Exercise could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'edit', $wod_id]);

    }


    // 19 de Julio, pendiente para segunda versión

    public function addExercise($id = null){
        $ewod = $this->Wods->ExercisesWods->newEntity();

        if ($this->request->is('post')) {
            $wod = $this->Wods->ExercisesWods->patchEntity($ewod, $this->request->data);
            if ($this->Wods->ExercisesWods->save($ewod)) {
                $this->Flash->success(__('The exercise has been saved.'));
                return $this->redirect(['action' => 'edit', $id]);
            } else {
                $this->Flash->error(__('The wod could not be saved. Please, try again.'));
            }
        }
        //$scores = $this->Wods->Scores->find('list', ['limit' => 200]);
        $exercises = $this->Wods->Exercises->find('list', ['limit' => 200]);
        //$workouts = $this->Wods->Workouts->find('list', ['limit' => 200]);
        $this->set(compact('ewod', 'exercises'));
        $this->set('_serialize', ['ewod']);
    }

    public function pruebas(){
        //wod 1
        $array = [
            "weight",
            [
                "reps",
                "variant" => ["M", "R", "A"]
            ]
        ];



        $result = [
            "weigth" => 300,
            [
                "reps" => 11,
                "variant" => "M"
            ]
        ];




        debug($array);
        debug($result);
        exit;
    }
}
