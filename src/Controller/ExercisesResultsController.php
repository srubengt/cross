<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ExercisesResults Controller
 *
 * @property \App\Model\Table\ExercisesResultsTable $ExercisesResults
 */
class ExercisesResultsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Reservations', 'ExercisesWorkouts']
        ];
        $exercisesResults = $this->paginate($this->ExercisesResults);

        $this->set(compact('exercisesResults'));
        $this->set('_serialize', ['exercisesResults']);
    }

    /**
     * View method
     *
     * @param string|null $id Exercises Result id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $exercisesResult = $this->ExercisesResults->get($id, [
            'contain' => ['Reservations', 'ExercisesWorkouts']
        ]);

        $this->set('exercisesResult', $exercisesResult);
        $this->set('_serialize', ['exercisesResult']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $exercisesResult = $this->ExercisesResults->newEntity();
        if ($this->request->is('post')) {
            $exercisesResult = $this->ExercisesResults->patchEntity($exercisesResult, $this->request->data);
            if ($this->ExercisesResults->save($exercisesResult)) {
                $this->Flash->success(__('The exercises result has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The exercises result could not be saved. Please, try again.'));
            }
        }
        $reservations = $this->ExercisesResults->Reservations->find('list', ['limit' => 200]);
        $exercisesWorkouts = $this->ExercisesResults->ExercisesWorkouts->find('list', ['limit' => 200]);
        $this->set(compact('exercisesResult', 'reservations', 'exercisesWorkouts'));
        $this->set('_serialize', ['exercisesResult']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Exercises Result id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $exercisesResult = $this->ExercisesResults->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $exercisesResult = $this->ExercisesResults->patchEntity($exercisesResult, $this->request->data);
            if ($this->ExercisesResults->save($exercisesResult)) {
                $this->Flash->success(__('The exercises result has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The exercises result could not be saved. Please, try again.'));
            }
        }
        $reservations = $this->ExercisesResults->Reservations->find('list', ['limit' => 200]);
        $exercisesWorkouts = $this->ExercisesResults->ExercisesWorkouts->find('list', ['limit' => 200]);
        $this->set(compact('exercisesResult', 'reservations', 'exercisesWorkouts'));
        $this->set('_serialize', ['exercisesResult']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Exercises Result id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $exercisesResult = $this->ExercisesResults->get($id);
        if ($this->ExercisesResults->delete($exercisesResult)) {
            $this->Flash->success(__('The exercises result has been deleted.'));
        } else {
            $this->Flash->error(__('The exercises result could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
