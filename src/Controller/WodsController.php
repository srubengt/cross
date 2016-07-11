<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\ExercisesWodsTable;

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
        $this->paginate = [
            'contain' => ['Scores']
        ];
        $wods = $this->paginate($this->Wods);
        
        $this->set('small_text', 'Listado de Wods');
        $this->set('title_layout', 'Wods Crossfit');
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
            'contain' => ['Scores', 'Exercises', 'Workouts']
        ]);

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
        $scores = $this->Wods->Scores->find('list', ['limit' => 200]);
        $exercises = $this->Wods->Exercises->find('list', ['limit' => 200]);
        $workouts = $this->Wods->Workouts->find('list', ['limit' => 200]);
        $this->set(compact('wod', 'scores', 'exercises', 'workouts'));
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
        $wod = $this->Wods->get($id, [
            'contain' => ['Exercises', 'Workouts']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $wod = $this->Wods->patchEntity($wod, $this->request->data);
            if ($this->Wods->save($wod)) {
                $this->Flash->success(__('The wod has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The wod could not be saved. Please, try again.'));
            }
        }

        $scores = $this->Wods->Scores->find('list', ['limit' => 200]);
        $exercises = $this->Wods->Exercises->find('list', ['limit' => 200]);
        $workouts = $this->Wods->Workouts->find('list', ['limit' => 200]);
        $this->set(compact('wod', 'scores', 'exercises', 'workouts'));
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
        $wod = $this->Wods->get($id);
        if ($this->Wods->delete($wod)) {
            $this->Flash->success(__('The wod has been deleted.'));
        } else {
            $this->Flash->error(__('The wod could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
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

    public function queries($id = null){
        //Function para hacer pruebas de consultas.

        $q = $this->Wods
            ->find('all')
            ->contain(['ExercisesWods.Exercises'])
            ->where(['Wods.wod_id' => $id])
            ;

        debug($q->toArray());
        exit;



        $query = $this->Wods
            ->find('all')

            // contain needs to use `Students` instead (the `CourseMemberships`
            // data can be found in the `_joinData` property of the tag),
            // or dropped alltogether in case you don't actually need that
            // data in your results
            ->contain(['Exercises'])

            // this will do the magic
            ->matching('Exercises')

            ->where([
                'ExercisesWods.wod_id' => $id
            ]);

        debug($query->toArray());
        die();
    }
}
