<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\Validation\Validator;
use Cake\Utility\Hash;

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
        //debug($this->request->param('pass'));
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
            ->order(['start' => 'ASC'])
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
            //Si existe user_id, es que tenemos permiso de administrador.

            if (Hash::check($this->request->data, 'user_id')){
                if (in_array($this->Auth->user('role_id'), [1,2], true)) {
                    $reservation = $this->Reservations->patchEntity($reservation, $this->request->data);
                }else{
                    $this->Flash->error(__('The reservation could not be saved. Please, try again.'));
                    return $this->redirect(['action' => 'viewsession', 'id' => $this->request->data['session_id']]);
                }
            }else{
                $reservation = $this->Reservations->patchEntity($reservation, $this->request->data);
                $reservation->user_id = $this->Auth->user('id');
            }

            //Validamos si existe alguna otra reserva para del user_id para la fecha_session
            //*
            //++ El Usuario Administrador o Root, pueden generar tantas reservas para usuarios como quiera.
            //++ Se ha creado un Usuario Invitado, el cual será el que reciba todas las invitaciones de personas par el Gym
            //*/

            $save = true;

            if (!in_array($this->Auth->user('role_id'), [1,2], true)) {
                $fecha = Time::parseDate($reservation->fecha_session);

                $q = $this->Reservations->find('all', [
                    'contain' => ['Sessions']
                ]);
                $q
                    ->where([
                        'Reservations.user_id' => $reservation->user_id,
                        'Sessions.date' => $fecha
                    ]);

                if (!empty($q->toArray())) {
                    $save = false;
                    $this->Flash->error(__('Ya existe una reserva para esta fecha {0}', $fecha->i18nformat("dd-MM-yyyy")));
                }else{
                    if ($this->checkTimeAddReservation($reservation->session_id)){
                        $save = true;
                    }else{
                        $save = false;
                    }
                }
            }

            if ($save){
                if ($this->Reservations->save($reservation)) {
                    $this->Flash->success(__('The reservation has been saved.'));
                } else {
                    $this->Flash->error(__('The reservation could not be saved. Please, try again.'));
                }
            }
            return $this->redirect(['action' => 'viewsession', 'id' => $this->request->data['session_id']]);
        }else{
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Reservation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null){

        $this->request->allowMethod(['post', 'delete']);
        $reservation = $this->Reservations->get($id);

        $session_id = $reservation->session_id;
        if ($reservation->user_id === $this->Auth->user('id')) { //Si está eliminando su própia reserva
            if ($this->checkTimeDelReservation($reservation->session_id)){
                $delete = true;
            }else{
                $delete = false;
            }
        }else{
            if (in_array($this->Auth->user('role_id'), [1,2], true)) { // Si es administrador
                $delete = true;
            }else{ //Error, está realizando una acción ilegal.
                $this->Flash->error(__('The reservation could not be deleted. Please, try again.'));
                $delete = false;
            }
        }

        if ($delete) {
            if ($this->Reservations->delete($reservation)) {
                $this->Flash->success(__('The reservation has been deleted.'));
            } else {
                $this->Flash->error(__('The reservation could not be deleted. Please, try again.'));
            }
        }

        return $this->redirect(['action' => 'viewsession', 'id' => $session_id]);
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


    protected function checkTimeAddReservation($id = null){
        $date = new Date(); //Obtenemos la fecha de hoy
        $session = $this->Reservations->Sessions->get($id);

        if ($date > $session->date){
            //Como la fecha es mayor, no comparamos las horas.
            //Directamente no se puede crear la reserva sobre una session ya vencida.
            $this->Flash->error(__('Session ya vencida, no se puede crear la reserva.'));
            return false;
        }else{
            if ($date == $session->date){ //Estamos en el mismo día
                //Comparamos entonces las horas de la reserva con la hora actual.
                $time = Time::now();
                $time_session = new Time($session->start); //Frozen Time to Time

                //debug($time);
                //debug($time_session);

                $diff = $time->diff($time_session);
                //debug($diff);

                if ($diff->invert){ // Se ha superado la hora de la session
                    $this->Flash->error(__('Session ya vencida, no se puede crear la reserva.'));
                    return false;
                    //$save = false;
                }else{
                    //No se ha superado la hora de la sessión.
                    //Por norma, sólo se puede reservar 10 minutos antes de la sessión.
                    if ($diff->h == 0){
                        if ($diff->i >= 10){
                            //Quedan más de 10 minutos, se puede reservar.
                            return true;
                            //$save = true;
                        }else{
                            //Estamos en los 10 minutos antes de la session, no se puede reservar.
                            $this->Flash->error(__('No se puede crear la reserva. Tiempo Max. 10 min. antes de la clase.'));
                            return false;
                            //$save = false;
                        }
                    }else{
                        //$save = true;
                        return true;
                    }
                }
            }else{ //Es una reserva de fecha mayor
                return true;
                //$save = true;
            }
        }
    }

    protected function checkTimeDelReservation($id = null){
        $date = new Date(); //Obtenemos la fecha de hoy
        $session = $this->Reservations->Sessions->get($id);

        if ($date > $session->date){
            //Como la fecha es mayor, no comparamos las horas.
            //Directamente no se puede crear la reserva sobre una session ya vencida.
            $this->Flash->error(__('Session ya vencida, no se puede eliminar la reserva.'));
            return false;
        }else{
            if ($date == $session->date){ //Estamos en el mismo día
                //Comparamos entonces las horas de la reserva con la hora actual.
                $time = Time::now();
                $time_session = new Time($session->start); //Frozen Time to Time
                $diff = $time->diff($time_session);

                if ($diff->invert){ // Se ha superado la hora de la session
                    $this->Flash->error(__('Session ya vencida, no se puede eliminar la reserva.'));
                    return false;
                }else{
                    //No se ha superado la hora de la sessión.
                    //Por norma, sólo se puede eliminar una reserva 1 hora antes de la sessión.
                    if ($diff->h >= 1){
                        //Quedan 1 hora o más, se puede reservar.
                        return true;
                    }else{
                        //$save = true;
                        $this->Flash->error(__('No se puede eliminar la reserva. Tiempo Max. 1h. antes de la clase.'));
                        return false;
                    }
                }
            }else{ //Es una reserva de fecha mayor
                return true;
            }
        }
    }
}
