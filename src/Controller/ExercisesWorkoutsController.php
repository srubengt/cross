<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ExercisesWorkouts Controller
 *
 * @property \App\Model\Table\ExercisesWorkoutsTable $ExercisesWorkouts
 */
class ExercisesWorkoutsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Workouts', 'Exercises']
        ];
        $exercisesWorkouts = $this->paginate($this->ExercisesWorkouts);

        $this->set(compact('exercisesWorkouts'));
        $this->set('_serialize', ['exercisesWorkouts']);
    }

    /**
     * View method
     *
     * @param string|null $id Exercises Workout id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $exercisesWorkout = $this->ExercisesWorkouts->get($id, [
            'contain' => ['Workouts', 'Exercises']
        ]);

        $this->set('exercisesWorkout', $exercisesWorkout);
        $this->set('_serialize', ['exercisesWorkout']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $exercisesWorkout = $this->ExercisesWorkouts->newEntity();
        if ($this->request->is('post')) {
            $exercisesWorkout = $this->ExercisesWorkouts->patchEntity($exercisesWorkout, $this->request->data);
            if ($this->ExercisesWorkouts->save($exercisesWorkout)) {
                $this->Flash->success(__('The exercises workout has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The exercises workout could not be saved. Please, try again.'));
            }
        }
        $workouts = $this->ExercisesWorkouts->Workouts->find('list', ['limit' => 200]);
        $exercises = $this->ExercisesWorkouts->Exercises->find('list', ['limit' => 200]);
        $this->set(compact('exercisesWorkout', 'workouts', 'exercises'));
        $this->set('_serialize', ['exercisesWorkout']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Exercises Workout id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $exercisesWorkout = $this->ExercisesWorkouts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $exercisesWorkout = $this->ExercisesWorkouts->patchEntity($exercisesWorkout, $this->request->data);
            if ($this->ExercisesWorkouts->save($exercisesWorkout)) {
                $this->Flash->success(__('The exercises workout has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The exercises workout could not be saved. Please, try again.'));
            }
        }
        $workouts = $this->ExercisesWorkouts->Workouts->find('list', ['limit' => 200]);
        $exercises = $this->ExercisesWorkouts->Exercises->find('list', ['limit' => 200]);
        $this->set(compact('exercisesWorkout', 'workouts', 'exercises'));
        $this->set('_serialize', ['exercisesWorkout']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Exercises Workout id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $exercisesWorkout = $this->ExercisesWorkouts->get($id);
        if ($this->ExercisesWorkouts->delete($exercisesWorkout)) {
            $this->Flash->success(__('The exercises workout has been deleted.'));
        } else {
            $this->Flash->error(__('The exercises workout could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
