<?php
namespace App\Controller;

use App\Controller\AppController;

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

    public function deleteExercise($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $wod_id = $this->request->params['pass'][0];
        $exercise_id = $this->request->params['pass'][1];

        $exercise = $this->Wods->Exercises->get($exercise_id);

        debug($exercise);
        die();
        if ($this->Wods->delete($exercise)) {
            $this->Flash->success(__('The exercise has been deleted.'));
        } else {
            $this->Flash->error(__('The exercise could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'edit', $wod_id]);
    }
}
