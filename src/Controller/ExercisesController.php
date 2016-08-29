<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Exercises Controller
 *
 * @property \App\Model\Table\ExercisesTable $Exercises
 */
class ExercisesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $search = '';

        $query = $this->Exercises->find();
        if ($this->request->is('post')) {
            $search = $this->request->data['search'];
            if ($search) {
                $query->where(['Exercises.name LIKE' => '%' . $search . '%']);
            }
        }

        $exercises = $this->paginate($query);

        $this->set('search', $search);
        $this->set(compact('exercises'));
        $this->set('_serialize', ['exercises']);
    }

    /**
     * View method
     *
     * @param string|null $id Exercise id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $exercise = $this->Exercises->get($id, [
            //'contain' => ['Results', 'Wods', 'Workouts']
            'contain' => ['Wods', 'Workouts']
        ]);

        $this->set('exercise', $exercise);
        $this->set('_serialize', ['exercise']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $exercise = $this->Exercises->newEntity();
        if ($this->request->is('post')) {
            $exercise = $this->Exercises->patchEntity($exercise, $this->request->data);
            if ($this->Exercises->save($exercise)) {
                $this->Flash->success(__('The exercise has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The exercise could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('exercise'));
        $this->set('_serialize', ['exercise']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Exercise id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $exercise = $this->Exercises->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            if (empty($this->request->data['photo'])){
                unset($this->request->data['photo']);
            }

            //debug($this->request->data);
            //die();

            $exercise = $this->Exercises->patchEntity($exercise, $this->request->data);

            if ($this->Exercises->save($exercise)) {
                $this->Flash->success(__('The exercise has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The exercise could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('exercise'));
        $this->set('_serialize', ['exercise']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Exercise id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $exercise = $this->Exercises->get($id);
        if ($this->Exercises->delete($exercise)) {
            $this->Flash->success(__('The exercise has been deleted.'));
        } else {
            $this->Flash->error(__('The exercise could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function deleteImage($id = null){

        // Deleting the upload?
        $exercise = $this->Exercises->get($id);

        $this->request->data['photo_dir'] = null;
        $this->request->data['photo'] = null;

        $path = new \Proffer\Lib\ProfferPath($this->Exercises, $exercise, 'photo', $this->Exercises->behaviors()->Proffer->config('photo'));



        $exercise = $this->Exercises->patchEntity($exercise, $this->request->data);
        if ($this->Exercises->save($exercise)) {
            $path->deleteFiles($path->getFolder(), true);
            $this->Flash->success(__('The image has been deleted.'));
            return $this->redirect(['action' => 'edit', $id]);
        } else {
            $this->Flash->error(__('The image could not be saved. Please, try again.'));
        }

        return $this->redirect(['action' => 'edit', $id]);

    }
}
