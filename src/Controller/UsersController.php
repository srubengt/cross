<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

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
       
        $this->paginate = [
            'contain' => ['Roles']
        ];
        $users = $this->paginate($this->Users);
        
        $this->set('small_text', 'Listado de Usuarios');
        $this->set('title_layout', 'Usuarios');
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
     * upload method
     * Método para asignar la imagen de perfil de usuario.
     */
    public function upload($id)
    {
        //Obtenemos los datos de imagen de usuario.
        $realimage = $this->Users
            ->find()
            ->select('Users.image')
            ->where([
                    'Users.id' => $id
                ])
            ->toArray()[0]['image'];
        
        if ( !empty( $this->request->data ) ) {
            //debug($this->request->data['uploadfile'][0]['error']);
            //exit;
            if ($this->request->data['uploadfile'][0]['error'] == 0){
                
                $options = array(
                    "allowed" => ['png', 'jpg', 'jpeg'],
                    "redim" => true,
                    "height" => 90,
                    "width" => 90,
                    "controller" => "users",
                    "id" => $id,
                    "dir" => "profile" //Carpeta donde se guardará el archivo (nombre final: id_[filename].[ext]).
                );
                
                $retorno = $this->Upload->send($this->request->data['uploadfile'], $options);
                
                $filename = $retorno[0]; //nuevo nombre de la imagen devuelto
                
                //Actualizamos el registro en la base de datos
                $usersTable = TableRegistry::get('Users');
                $user = $usersTable->get($id);
                $user->image = $filename;
                $usersTable->save($user);
                
                //Eliminamos la imagen anterior que está en el servidor.
                if ( $realimage != '' ){
                    $fullpath = WWW_ROOT.'uploads'.DS.$options['dir'].DS.$realimage;
                    if (file_exists($fullpath)) {
                        unlink($fullpath);
                    }
                }
                    
                $this->Flash->success(__('Imagen de usuario subida'));
            }else{
                $this->Flash->error(__('Error al subir la imagen'));
            }
        }else{
            $this->Flash->error(__('Error al subir la imagen'));
        }
        
        return $this->redirect(['controller' => 'users', 'action' => 'edit', $id]);
    }
}
