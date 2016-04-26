<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * WodsWorkouts Controller
 *
 * @property \App\Model\Table\WodsWorkoutsTable $WodsWorkouts
 */
class WodsWorkoutsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Wods', 'Workouts']
        ];
        $wodsWorkouts = $this->paginate($this->WodsWorkouts);

        $this->set(compact('wodsWorkouts'));
        $this->set('_serialize', ['wodsWorkouts']);
    }

    /**
     * View method
     *
     * @param string|null $id Wods Workout id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $wodsWorkout = $this->WodsWorkouts->get($id, [
            'contain' => ['Wods', 'Workouts']
        ]);

        $this->set('wodsWorkout', $wodsWorkout);
        $this->set('_serialize', ['wodsWorkout']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $wodsWorkout = $this->WodsWorkouts->newEntity();
        if ($this->request->is('post')) {
            $wodsWorkout = $this->WodsWorkouts->patchEntity($wodsWorkout, $this->request->data);
            if ($this->WodsWorkouts->save($wodsWorkout)) {
                $this->Flash->success(__('The wods workout has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The wods workout could not be saved. Please, try again.'));
            }
        }
        $wods = $this->WodsWorkouts->Wods->find('list', ['limit' => 200]);
        $workouts = $this->WodsWorkouts->Workouts->find('list', ['limit' => 200]);
        $this->set(compact('wodsWorkout', 'wods', 'workouts'));
        $this->set('_serialize', ['wodsWorkout']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Wods Workout id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $wodsWorkout = $this->WodsWorkouts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $wodsWorkout = $this->WodsWorkouts->patchEntity($wodsWorkout, $this->request->data);
            if ($this->WodsWorkouts->save($wodsWorkout)) {
                $this->Flash->success(__('The wods workout has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The wods workout could not be saved. Please, try again.'));
            }
        }
        $wods = $this->WodsWorkouts->Wods->find('list', ['limit' => 200]);
        $workouts = $this->WodsWorkouts->Workouts->find('list', ['limit' => 200]);
        $this->set(compact('wodsWorkout', 'wods', 'workouts'));
        $this->set('_serialize', ['wodsWorkout']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Wods Workout id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $wodsWorkout = $this->WodsWorkouts->get($id);
        if ($this->WodsWorkouts->delete($wodsWorkout)) {
            $this->Flash->success(__('The wods workout has been deleted.'));
        } else {
            $this->Flash->error(__('The wods workout could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
