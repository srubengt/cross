<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use App\Controller\AuthComponent;
use Cake\Utility\Hash;

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
        if ($this->request->action == 'logout'){
            return true;
        }
        // All registered users can logout
        switch ($user['role_id']){
            case 3: //User
                switch ($this->request->action){
                    case 'logout':
                    case 'profile':
                        return true;
                        break;
                }
                break;
        }

        if ($this->request->action == 'dropin'){
            return true;
        }

        //Return 
        return parent::isAuthorized($user);
    }

    public function index()
    {
        $search = '';

        $query = $this->Users->find('all',[
                'contain' => [
                    'Roles',
                    'Partners' => function ($q) {
                        return $q->formatResults(function (\Cake\Collection\CollectionInterface $partners){
                            return $partners->map(function ($partner){
                                if ($partner->active)
                                {
                                    return $partner;
                                }
                            });
                        });
                    }
                ]
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
        
        $this->set('small', 'Users List');
        $this->set('title', 'Users');
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
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
            $save = true;
            if ($this->Auth->user('role_id') == 2){ // Es usuario administrador.
                if ($this->Auth->user('role_id') > $user->role_id){
                    //No puede crear un usuario con más privilegios que su própio rol.
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                    $save = false;
                }
            }

            if ($save){
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('El usuario ha sigo guardado.'));

                    $result=$this->Users->find('all')->last();

                    return $this->redirect(['action' => 'edit', $result->id]);
                } else {
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            }

        }

        $role_auth = $this->Users->Roles->get($this->Auth->user('role_id'));
        $orden = $role_auth->orden;


        $roles = $this->Users->Roles->find('list', ['limit' => 200])
            ->where(['Roles.orden >= ' => $orden])
            ->order(['orden' => 'ASC'])
        ;
        

        $back = [
            'controller' => 'users',
            'action' => 'index',
            'val' => ''
        ];

        $this->set('small', 'Add');
        $this->set('title', 'Users');
        $this->set('back', $back);

        $this->set('idcards', Configure::read('IdCards'));

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
            'contain' => ['Partners']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->data;


            //Si el precio no se define, se establece el precio que tiene la Tarifa por defecto.

            if (Hash::check($data, 'partners') && (Hash::extract($data,'partners.{n}.price')[0]) == '' && (Hash::extract($data,'partners.{n}.rate')[0]) != ''){
                $this->loadModel('Rates');
                $rate = Hash::extract($data,'partners.{n}.rate');
                $query = $this->Rates->findById($rate[0])->toArray();
                $price = $query[0]->price;
                $data = Hash::insert($data,'partners.{n}.price', $price);
            }


            $user = $this->Users->patchEntity($user, $data,[
                'associated' => 'Partners'
            ]);

            if (($user->dirty('photo')) && ($user->getOriginal('photo'))){
                $this->deleteImage($user->id);
            };


            if ($this->Users->save($user)) {
                //Si el usuario modificado es el mismo que está logueado, actulizamos los datos de session
                if ($user->id === $this->Auth->user('id')){
                    $data = $user->toArray();
                    unset($data['password']);
                    $this->Auth->setUser($data);
                }

                $this->Flash->success(__('The user has been saved.'));
                //return $this->redirect(['action' => 'edit', $user->id]);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
            return $this->redirect(['action' => 'edit', $user->id]);

        }

        $role_auth = $this->Users->Roles->get($this->Auth->user('role_id'));
        $orden = $role_auth->orden;

        $roles = $this->Users->Roles->find('list', ['limit' => 200])
            ->where(['Roles.orden >= ' => $orden])
            ->order(['orden' => 'ASC'])
        ;



        $this->loadModel('Rates');
        $q = $this->Rates->find('all')->toArray();

        foreach ($q as $key => $item) {
            $rates[$item->id] = $item->name . ' (' . $item->price . ' €)';
        }

        $back = [
            'controller' => 'users',
            'action' => 'index',
            'val' => ''
        ];

        $this->set('small', 'Edit');
        $this->set('title', 'Users');
        $this->set('back', $back);

        $this->set('idcards', Configure::read('IdCards'));

        $this->set(compact('user', 'roles', 'rates'));
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
        //Eliminamos la imagen si existiera
        $this->deleteImage($id);

        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    


    /**
     * Profile
     * Mostramos el perfil del usuario para su gestión
     */
    public function profile(){

        //Obtenemos la pesaña a visualizar según lo pasado por query
        if ($this->request->query){
            $tab = $this->request->query['tab'];
        }else{
            $tab = 'timeline';
        }

        $user = $this->Users->get($this->Auth->user('id'));

        if ($this->request->is(['patch', 'post', 'put'])) {
            //ini_set('memory_limit', '256M');

            $user = $this->Users->patchEntity($user, $this->request->data);

            if ($user->dirty('photo')){
                $this->deleteImage($user->id);
            };

            if ($this->Users->save($user)) {
                //Actualizamos los datos del Auth.User
                $data = $user->toArray();
                unset($data['password']);
                $this->Auth->setUser($data);

                $this->Flash->success(__('The user has been saved.'));
                $tab = 'settings';
                return $this->redirect(['action' => 'profile', 'tab' => 'settings']);
            }   else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
                $tab = 'settings';
            }
        }
        //Timeline
        //Obtenemos todos los WorkOuts realizados por el Usuario logueado, con los wods relacionados y la imagen del
        //workout que ha sido subida.
        $timeline = $this->Users->Reservations->find('all',
            [
                'contain' => ['Sessions.Workouts.Wods']
            ]
            );

        $timeline
            ->where(['Reservations.user_id' => $this->Auth->user('id')])
            ->order(['Sessions.date' => 'DESC'])
            ;

        $this->set('title', 'User');
        $this->set('small', 'Profile');
        $this->set('timeline', $timeline);
        $this->set('tab', $tab);
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

        //Timeline
        //Obtenemos todos los WorkOuts realizados por el Usuario logueado, con los wods relacionados y la imagen del
        //workout que ha sido subida.
        $timeline = $this->Users->Reservations->find('all',
            [
                'contain' => ['Sessions.Workouts.Wods']
            ]
        );

        $timeline
            ->where(['Reservations.user_id' => $this->Auth->user('id')])
            ->order(['Sessions.date' => 'DESC'])
        ;

        $this->set('timeline', $timeline);
        $this->set(compact('user'));
        $this->set('tab', 'pass');
        return $this->render('profile');
    }

    protected function deleteImage($id = null){
        // Deleting the upload?
        $user = $this->Users->get($id);
        if ($user->photo){
            $path = new \Proffer\Lib\ProfferPath($this->Users, $user, 'photo', $this->Users->behaviors()->Proffer->config('photo'));

            if ($path->deleteFiles($path->getFolder(), false)){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
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
     * drop-in method
     *
     */

    public function dropin(){
        $this->loadModel('Dropins');
        $dropin = $this->Dropins->newEntity();

        if ($this->request->is('post')) {
            //Validación del CAPTCHA
            $ip = getenv('REMOTE_ADDR');
            $gRecaptchaResponse = $this->request->data['g-recaptcha-response'];
            $captcha = $this->Captcha->check($ip,$gRecaptchaResponse);

            if($captcha->errorCodes == null) {
                // Success
                $dropin = $this->Dropins->patchEntity($dropin, $this->request->data);

                $q = $this->Users
                    ->find()
                    ->where(['Users.is_dropin' => true])
                    ->first()
                ;

                if ($q) { //Existe usuario asignado a Drop-in
                    $dropin->user_id = $q->id;
                    if ($this->Dropins->save($dropin)) {
                        //Obtenemos el usuario que tiene asignado a true el valor de is_dropin
                        $user = $this->Users->get($q->id);

                        //Cambiamos el nombre para el usuario dropin
                        $user->name = $dropin->name;
                        $user->dropin_id = $dropin->id;

                        $this->Auth->setUser($user);
                        return $this->redirect([
                            'controller' => 'Pages',
                            'action' => 'home'
                        ]);
                    } else {
                        $this->Flash->error(__('The dropin could not be saved. Please, try again.'));
                    }
                }else{
                    $this->Flash->error('Acceso incorrecto. No Dropin User');
                }

            } else {
                // Fail! Maybe a bot?
                //Error
                $this->Flash->error('Acceso incorrecto');
            }

        }

        if ($this->Auth->user()){
            $this->redirect(['controller' => 'Pages', 'action' =>'home']);
        }

        $this->set(compact('dropin'));
        $this->set('_serialize', ['dropin']);
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
     * ClosePartner method
     * Establece a no activa la tarifa asociada al usuario (Baja, Cambio de Tarifa)
     * params: $id -> id partner, $user_id
     */

    public function closePartner($id = null, $user_id = null, $tag = null){

        $query = $this->request->query;

        if (Hash::check($query, 'tag')){
            switch ($query['tag']){
                case 'monthly':
                    $redirect = [
                        'controller' => 'payments',
                        'action' => 'monthly'
                    ];
                    break;
                default:
                    $redirect = [
                        'controller' => 'users',
                        'action' => 'edit',
                        $user_id
                    ];
            }
        }else{
            $redirect = [
                'controller' => 'users',
                'action' => 'edit',
                $user_id
            ];
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->get($user_id,[
                'contain' => 'Partners'
            ]);

            $data['partners'] = [
                [
                    'id' => $id,
                    'active' => false
                ]
            ];

            $user = $this->Users->patchEntity($user, $data, [
                'associated' =>  [
                    'Partners'
                ]
            ]);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
            }else{
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }



            return $this->redirect($redirect);

        }

        $this->Flash->error(__('Error. Please, try again.'));
        return $this->redirect($redirect);
    }

    public function deletePartner($partner_id = null, $user_id = null){

        $user =  $this->Users->get($user_id);
        $partner = $this->Users->Partners->get($partner_id);
        $this->Users->Partners->unlink($user, [$partner]);
        return $this->redirect(['action' => 'edit', $user_id]);
    }
}
