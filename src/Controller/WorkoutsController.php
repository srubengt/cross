<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Workouts Controller
 *
 * @property \App\Model\Table\WorkoutsTable $Workouts
 */
class WorkoutsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $workouts = $this->paginate($this->Workouts);
        
        $this->set('small_text', 'Listado de Usuarios');
        $this->set('title_layout', 'Usuarios');
        $this->set(compact('workouts'));
        $this->set('_serialize', ['workouts']);
    }

    /**
     * View method
     *
     * @param string|null $id Workout id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $workout = $this->Workouts->get($id, [
            'contain' => ['Exercises', 'Wods', 'Sessions']
        ]);

        $this->set('workout', $workout);
        $this->set('_serialize', ['workout']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $workout = $this->Workouts->newEntity();
        if ($this->request->is('post')) {
            $workout = $this->Workouts->patchEntity($workout, $this->request->data);
            if ($this->Workouts->save($workout)) {
                $this->Flash->success(__('The workout has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The workout could not be saved. Please, try again.'));
            }
        }
        $exercises = $this->Workouts->Exercises->find('list', ['limit' => 200]);
        $wods = $this->Workouts->Wods->find('list', ['limit' => 200]);
        $this->set(compact('workout', 'exercises', 'wods'));
        $this->set('_serialize', ['workout']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Workout id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $workout = $this->Workouts->get($id, [
            'contain' => ['Exercises', 'Wods']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $workout = $this->Workouts->patchEntity($workout, $this->request->data);
            if ($this->Workouts->save($workout)) {
                $this->Flash->success(__('The workout has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The workout could not be saved. Please, try again.'));
            }
        }
        $exercises = $this->Workouts->Exercises->find('list', ['limit' => 200]);
        $wods = $this->Workouts->Wods->find('list', ['limit' => 200]);
        $this->set(compact('workout', 'exercises', 'wods'));
        $this->set('_serialize', ['workout']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Workout id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $workout = $this->Workouts->get($id);
        if ($this->Workouts->delete($workout)) {
            $this->Flash->success(__('The workout has been deleted.'));
        } else {
            $this->Flash->error(__('The workout could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
