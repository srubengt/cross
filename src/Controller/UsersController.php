<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Controller\AuthComponent;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
 
class UsersController extends AppController
{

    
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Upload');
    }
    
    
    public function isAuthorized($user)
    {
        // All registered users can logout
        if ($this->request->action === 'logout') {
            return true;
        }
        
        // All registered users can index
        if ($this->request->action === 'index') {
            return true;
        }
        
        
        //Return 
        return parent::isAuthorized($user);
    }
     
     
     
    public function index()
    {
        $search = '';

        $query = $this->Users->find('all',[
                'contain' => ['Roles']
            ]
        );
        if ($this->request->is('post')) {
            $search = $this->request->data['search'];
            if ($search) {
                $query->where(['Users.name LIKE' => '%' . $search . '%']);
            }
        }

        $users = $this->paginate($query);

        $this->set('search', $search);
        
        $this->set('small_text', 'Users List');
        $this->set('title_layout', 'Users');
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }


    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Reservations.Sessions', 'Roles']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario ha sigo guardado.'));
                
                $result=$this->Users->find('all')->last();
                
                return $this->redirect(['action' => 'edit', $result->id]);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                //return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * login method
     * 
     */
    
    public function login(){
        
        if ($this->request->is('post')){ //Comprobamos que el envío ha sido por POST
            $user = $this->Auth->identify();
            if ($user){
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            //User not Indentify
            $this->Flash->error('Usuario / password incorrecto.');
        }

        if ($this->Auth->user()){
            $this->redirect(['controller' => 'Pages', 'action' =>'home']);
        }
    }
    
    /**
     * logout method
     * 
     */
    public function logout(){
        $this->Flash->success('Sesión Cerrada');
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Profile
     * Mostramos el perfil del usuario para su gestión
     */
    public function profile(){
        $user = $this->Users->get($this->Auth->user('id'));

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                //return $this->redirect(['action' => 'profile']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
    }

    public function changepass(){
        $this->autoRender = false;
        $user = $this->Users->get($this->Auth->user('id'));
        if ($this->request->is(['patch', 'post', 'put'])) {

            //Comprobamos que sean iguales
            if ($this->request->data['newpass'] === $this->request->data['confirmpass']){
                $user = $this->Users->patchEntity($user , [
                    'password' => $this->request->data['newpass']
                ]);
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The pass has been saved.'));
                } else {
                    $this->Flash->error(__('The password could not be saved. Please, try again.'));
                }
            }else{
                $this->Flash->error(__('The password could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        return $this->render('profile');
    }

}
