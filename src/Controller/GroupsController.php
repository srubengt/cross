<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Groups Controller
 *
 * @property \App\Model\Table\GroupsTable $Groups
 */
class GroupsController extends AppController
{

    public function isAuthorized($user)
    {
        // All registered users can logout

        switch ($user['role_id']){
            case 3: //User
                switch ($this->request->action){
                    case 'index':
                    case 'view':
                        return true;
                        break;
                }
                break;
        }

        //  Return
        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $search = '';

        $groups = $this->Groups->find('all',[
            'order' => ['Groups.name' => 'ASC']
        ]);
        if ($this->request->is('post')) {
            $search = $this->request->data['search'];
            if ($search) {
                $groups
                    ->where(['name LIKE' => '%' . $search . '%'])
                ;
            }
        }

        $this->set('title', 'Exercises');
        $this->set('small', 'Groups of Exercises');

        $this->set(compact('groups'));
        $this->set('search', $search);
        $this->set('_serialize', ['groups']);
    }

    /**
     * View method
     *
     * @param string|null $id Group id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $group = $this->Groups->get($id, [
            'contain' => [
                'Exercises' => [
                    'sort' => ['Exercises.name' => 'asc']
                ]
            ]
        ]);

        $back = [
            'controller' => 'groups',
            'action' => 'index',
            'val' => ''
        ];

        $this->set('back', $back);
        $this->set('title', 'Groups');
        $this->set('small', $group->name);
        $this->set('group', $group);
        $this->set('_serialize', ['group']);
    }


    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $group = $this->Groups->newEntity();
        if ($this->request->is('post')) {
            $group = $this->Groups->patchEntity($group, $this->request->data);
            if ($this->Groups->save($group)) {
                $this->Flash->success(__('The exercise has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The exercise could not be saved. Please, try again.'));
            }
        }

        $back = [
            'controller' => 'groups',
            'action' => 'index',
            'val' => ''
        ];

        $this->set('back', $back);
        $this->set(compact('group'));
        $this->set('_serialize', ['group']);
    }


    /**
     * Edit method
     *
     * @param string|null $id Group id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $group = $this->Groups->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $group = $this->Groups->patchEntity($group, $this->request->data);

            if ($group->dirty('photo')){
                $this->delImage($group->id);
            };

            if ($this->Groups->save($group)) {
                $this->Flash->success(__('The group has been saved.'));

                return $this->redirect(['action' => 'edit', $group->id]);
            } else {
                $this->Flash->error(__('The group could not be saved. Please, try again.'));
            }
        }

        $back = [
            'controller' => 'groups',
            'action' => 'index',
            'val' => ''
        ];

        $this->set('title', 'Groups');
        $this->set('small', 'Edit');

        $this->set('back', $back);
        $this->set(compact('group'));
        $this->set('_serialize', ['group']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Group id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $group = $this->Groups->get($id);
        if ($this->Groups->delete($group)) {
            $this->Flash->success(__('The group has been deleted.'));
        } else {
            $this->Flash->error(__('The group could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    protected function delImage($id = null){
        // Deleting the upload?
        $reg = $this->Groups->get($id);
        if ($reg->photo){
            $path = new \Proffer\Lib\ProfferPath($this->Groups, $reg, 'photo', $this->Groups->behaviors()->Proffer->config('photo'));
            if ($path->deleteFiles($path->getFolder(), false)){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }
}
