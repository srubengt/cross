<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ExercisesWods Controller
 *
 * @property \App\Model\Table\ExercisesWodsTable $ExercisesWods
 */
class ExercisesWodsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Wods', 'Exercises']
        ];
        $exercisesWods = $this->paginate($this->ExercisesWods);

        $this->set(compact('exercisesWods'));
        $this->set('_serialize', ['exercisesWods']);
    }

    /**
     * View method
     *
     * @param string|null $id Exercises Wod id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $exercisesWod = $this->ExercisesWods->get($id, [
            'contain' => ['Wods', 'Exercises']
        ]);

        $this->set('exercisesWod', $exercisesWod);
        $this->set('_serialize', ['exercisesWod']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $exercisesWod = $this->ExercisesWods->newEntity();
        if ($this->request->is('post')) {
            $exercisesWod = $this->ExercisesWods->patchEntity($exercisesWod, $this->request->data);
            if ($this->ExercisesWods->save($exercisesWod)) {
                $this->Flash->success(__('The exercises wod has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The exercises wod could not be saved. Please, try again.'));
            }
        }
        $wods = $this->ExercisesWods->Wods->find('list', ['limit' => 200]);
        $exercises = $this->ExercisesWods->Exercises->find('list', ['limit' => 200]);
        $this->set(compact('exercisesWod', 'wods', 'exercises'));
        $this->set('_serialize', ['exercisesWod']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Exercises Wod id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $exercisesWod = $this->ExercisesWods->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $exercisesWod = $this->ExercisesWods->patchEntity($exercisesWod, $this->request->data);
            if ($this->ExercisesWods->save($exercisesWod)) {
                $this->Flash->success(__('The exercises wod has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The exercises wod could not be saved. Please, try again.'));
            }
        }
        $wods = $this->ExercisesWods->Wods->find('list', ['limit' => 200]);
        $exercises = $this->ExercisesWods->Exercises->find('list', ['limit' => 200]);
        $this->set(compact('exercisesWod', 'wods', 'exercises'));
        $this->set('_serialize', ['exercisesWod']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Exercises Wod id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $exercisesWod = $this->ExercisesWods->get($id);
        if ($this->ExercisesWods->delete($exercisesWod)) {
            $this->Flash->success(__('The exercises wod has been deleted.'));
        } else {
            $this->Flash->error(__('The exercises wod could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
