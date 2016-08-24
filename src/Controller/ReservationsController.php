<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Validation\Validator;

/**
 * Reservations Controller
 *
 * @property \App\Model\Table\ReservationsTable $Reservations
 */
class ReservationsController extends AppController
{

    public function isAuthorized($user)
    {
        // All registered users can logout

        switch ($user['role_id']){
            case 3: //User
                switch ($this->request->action){
                    case 'logout':
                    case 'index':
                    case 'viewsession':
                    case 'add':
                    case 'delete':
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
        $this->loadModel('Sessions');
        //El index de Reservations mostrará el listado de clases para la fecha actual.
        if ($this->request->is('get')) {
            //Obtenemos la fecha enviada.
            $e = $this->request->param('pass');
            if (!empty($e)){
                $fecha = Time::parseDate($e[0] . '/' . $e[1] . '/' . $e[2]);
            }else{
                $fecha = Time::now();
            }
        }else{
            $fecha = Time::now();
        }

        $q = $this->Sessions->find('all')
            ->contain(['Reservations'])
            ->where(['date' => $fecha])
            ->toArray();

        //Obetenemos el id del workout del primer session
        if($q){
            $workout_id = $q[0]['workout_id'];
            if ($workout_id){
                $workout = $this->Reservations->Sessions->Workouts->get($workout_id,[
                    'contain' => ['Wods']
                ]);
            }else{
                $workout = [];
            }
        }else{
            $workout = [];
        }

        //Obtenemos los eventos donde el usuario ha reservado.
        $eu = $this->Sessions->find('all',['contain' => ['Reservations']]);
        $eu
            ->matching('Reservations')
            ->where(['Reservations.user_id' => $this->Auth->user('id') ])
        ;

        $day = $eu->func()->day([
            'date' => 'identifier'
        ]);

        //Eventos existentes en el mes actual según month
        $eventos_user = $eu
            ->select([
                'daySession' => $day,
                'date'
            ])
            ->distinct()
            ->where([
                'MONTH(date)' => $fecha->month
            ])
        ;

        //Enviar otra variable a la vista con los diferentes días que contienen eventos.
        $e = $this->Sessions->find('all',[
            'contain' => ['Reservations']
        ]);

        $day = $e->func()->day([
            'date' => 'identifier'
        ]);

        //Eventos existentes en el mes actual según month
        $eventos = $e
            ->select([
                'daySession' => $day,
                'date'
            ])
            ->distinct()
            ->where([
                'MONTH(date)' => $fecha->month
            ])
            ;

        $this->set('workout', $workout);
        $this->set('eventos', $eventos); //días de los eventos del més actual para
        $this->set('eventos_user', $eventos_user); //días de los eventos del usuario actual
        $this->set('month',$fecha->month); //Mes seleccionado
        $this->set('fecha', $fecha);
        $this->set('sessions', $q);
        $this->set('_serialize', [$q]);
    }

    /**
     * View method
     *
     * @param string|null $id Reservation id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reservation = $this->Reservations->get($id, [
            'contain' => ['Users', 'Sessions', 'ExercisesResults']
        ]);

        $this->set('reservation', $reservation);
        $this->set('_serialize', ['reservation']);
    }


    /*
     * View Session method
     * Muestra la session seleccionada desde las reservas, para crear una nueva reserva.
     * */

    public function viewSession(){

        //Obtenemos el id enviado por query para visualizar la Session
        $id = $this->request->query('id');

        //Cargamos el Modelo de las Sessions
        $this->loadModel('Sessions');

        $session = $this->Sessions->get($id,[
            'contain' => ['Reservations.Users', 'Workouts.Wods']
        ]);

        if (in_array($this->request->session()->read('Auth.User')['role_id'], [1,2], true)){
            $users = $this->Reservations->Users->find('list');

            $this->set('users', $users);
        }

        $this->set('session', $session);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reservation = $this->Reservations->newEntity();
        if ($this->request->is('post')) {
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->data);

            if ($this->Reservations->save($reservation)) {
                $this->Flash->success(__('The reservation has been saved.'));
            } else {
                $this->Flash->error(__('The reservation could not be saved. Please, try again.'));
            }

            return $this->redirect(['action' => 'viewsession', 'id' => $this->request->data['session_id']]);
        }else{
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Reservation id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        debug($id);
        die();
        /*$reservation = $this->Reservations->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->data);
            if ($this->Reservations->save($reservation)) {
                $this->Flash->success(__('The reservation has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The reservation could not be saved. Please, try again.'));
            }
        }

        $users = $this->Reservations->Users->find('list', ['limit' => 200]);
        $sessions = $this->Reservations->Sessions->find('list', ['limit' => 200]);
        $this->set(compact('reservation', 'users', 'sessions'));
        $this->set('_serialize', ['reservation']);*/
    }

    /**
     * Delete method
     *
     * @param string|null $id Reservation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reservation = $this->Reservations->get($id);

        //Comprobamos si la reserva a eliminar corresponde con la del usuario logueado.
        //Afirmativo: Redirect to index
        //Negativo: Redirect to viewSession

        if ($reservation->user_id == $this->Auth->id){
            $redirect = 'index';
        }else{
            $redirect = 'viewsession';
            $session_id = $reservation->session_id;
        }

        if ($this->Reservations->delete($reservation)) {
            $this->Flash->success(__('The reservation has been deleted.'));
        } else {
            $this->Flash->error(__('The reservation could not be deleted. Please, try again.'));
        }

        switch ($redirect){
            case 'index':
                return $this->redirect(['action' => 'index']);
                break;
            case 'viewsession':
                return $this->redirect(['action' => 'viewsession', 'id' => $session_id]);
                break;
            default: //Por si ocurre algún error.
                return $this->redirect(['action' => 'index']);
        }
    }

    public function addResult(){

        if ($this->request->is('post')){
            //Validamos los datos temporales enviados

            $validator = new Validator();
            $validator
                ->add('reps_result', 'valid', [
                    'rule' => 'numeric',
                    'message' => 'Debe introducir las repeticiones'
                ])
                ->notEmpty('reps_result', 'Campo Obligatorio.')
                ;

            //Validamos los datos.
            $errors = $validator->errors($this->request->data());
            if (!empty($errors)) {
                //Existe algún error
                $this->Flash->error('Debe Rellenar los resultados.');
                $this->redirect(['controller' => 'reservations', 'action' => 'viewsession', 'id' => $this->request->data('session_id')]);
            }else{
                //Si errores, generamos el array para guardar en results
                echo 'Guardar Datos';
                debug($this->request->data());
                die();
            }

        }
    }
}
