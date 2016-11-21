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
     * View method
     *
     * @param string|null $id Exercise id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $exercise = $this->Exercises->get($id,[
            'contain' => ['Groups']
        ]);

        //back: groups/view/x
        $back = [
            'controller' => 'groups',
            'action' => 'view',
            'val' => $exercise->group_id
        ];


        $this->set('back', $back);
        $this->set('exercise', $exercise);
        $this->set('_serialize', ['exercise']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */

    public function add($idGroup = null)
    {
        $exercise = $this->Exercises->newEntity();
        if ($this->request->is('post')) {
            $exercise = $this->Exercises->patchEntity($exercise, $this->request->data);
            $exercise->group_id = $idGroup;
            if ($this->Exercises->save($exercise)) {
                $this->Flash->success(__('The exercise has been saved.'));
                return $this->redirect(['controller' => 'groups', 'action' => 'view', $idGroup]);
            } else {
                $this->Flash->error(__('The exercise could not be saved. Please, try again.'));
            }
        }

        //back: groups/view/x
        $back = [
            'controller' => 'groups',
            'action' => 'view',
            'val' => $idGroup
        ];

        //Obetenemos los grupos de Ejercicios disponibles.
        $groups = $this->Exercises->Groups->find('list', ['limit' => 200]);

        //Details
        $details = $this->Exercises->Details->find('list', ['limit' => 200]);

        $this->set('idGroup', $idGroup);
        $this->set('groups', $groups);
        $this->set('details', $details);
        $this->set('back', $back);
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
            $exercise = $this->Exercises->patchEntity($exercise, $this->request->data);

            //Asignamos nuevamente el id de Grupo de Ejercicios
            //$exercise->group_id = $idGroup;

            if ($this->Exercises->save($exercise)) {
                $this->Flash->success(__('The exercise has been saved.'));
                return $this->redirect(['controller' => 'exercises','action' => 'view', $id]);
            } else {
                $this->Flash->error(__('The exercise could not be saved. Please, try again.'));
            }
        }

        $back = [
            'controller' => 'exercises',
            'action' => 'view',
            'val' => $id
        ];

        //Obetenemos los grupos de Ejercicios disponibles.
        $groups = $this->Exercises->Groups->find('list', ['limit' => 200]);

        //Details
        $details = $this->Exercises->Details->find('list', ['limit' => 200]);

        $this->set('back', $back);
        $this->set('groups', $groups);
        $this->set('details', $details);
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
        $idGroup = $exercise->group_id;

        if ($this->Exercises->delete($exercise)) {
            $this->Flash->success(__('The exercise has been deleted.'));
        } else {
            $this->Flash->error(__('The exercise could not be deleted. Please, try again.'));
        }
        return $this->redirect(['controller' => 'groups','action' => 'view', $idGroup]);
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

    public function listar(){
        /**
         * Lista los ejercicios a los usuarios con una templete adecuada de navegación.
        */
        $search = '';

        $query = $this->Exercises->find('all',[
            'order' => ['Exercises.name' => 'ASC']
        ]);
        if ($this->request->is('post')) {
            //debug($this->request->data);
            //die();
            $search = $this->request->data['search'];
            if ($search) {
                $query
                    ->where(['name LIKE' => '%' . $search . '%'])
                ;
            }
        }


        $exercises = $this->paginate($query);

        $this->set('search', $search);
        $this->set(compact('exercises'));
        $this->set('_serialize', ['exercises']);
    }
}
