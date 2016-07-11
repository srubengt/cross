<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

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
        if ($this->request->action === 'logout') {
            return true;
        }

        // All registered users can index
        if ($this->request->action === 'index') {
            return true;
        }

        // All registered users can index
        if ($this->request->action === 'viewsession') {
            return true;
        }


        //Return
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

        //Enviar otra variable a la vista con los diferentes días que contienen eventos.
        $e = $this->Sessions->find();
        $day = $e->func()->day([
            'date' => 'identifier'
        ]);
        $mes = $fecha->month;
        $e
            ->select([
                'daySession' => $day
            ])
            ->distinct()
            ->where([
                'MONTH(date)' => $mes
            ])
            ->toArray()
            ;
        $this->set('eventos', $e->toList()); //días de los eventos del més actual para
        $this->set('fecha', $fecha);
        $this->set('sessions', $q);
        $this->set('_serialize', [$q]);




        /*$this->paginate = [
            'contain' => ['Users', 'Sessions']
        ];
        $reservations = $this->paginate($this->Reservations);

        $this->set(compact('reservations'));
        $this->set('_serialize', ['reservations']);*/
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
            'contain' => ['Workouts', 'Reservations.Users']
        ]);



        if ($this->request->session()->read('Auth.User')['role_id'] == 1){
            $users = $this->Reservations->Users->find('list', ['limit' => 200]);
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
        //debug($this->request->data);
        //die();
        $reservation = $this->Reservations->newEntity();
        if ($this->request->is('post')) {
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->data);
            if ($this->Reservations->save($reservation)) {
                $this->Flash->success(__('The reservation has been saved.'));
                return $this->redirect(['action' => 'viewsession', 'id' => $this->request->data['session_id']]);
            } else {
                $this->Flash->error(__('The reservation could not be saved. Please, try again.'));
            }
        }else{
            return $this->redirect(['action' => 'index']);
        }
        /*$users = $this->Reservations->Users->find('list', ['limit' => 200]);
        $sessions = $this->Reservations->Sessions->find('list', ['limit' => 200]);
        $this->set(compact('reservation', 'users', 'sessions'));
        $this->set('_serialize', ['reservation']);*/
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
        $reservation = $this->Reservations->get($id, [
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
        $this->set('_serialize', ['reservation']);
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
        if ($this->Reservations->delete($reservation)) {
            $this->Flash->success(__('The reservation has been deleted.'));
        } else {
            $this->Flash->error(__('The reservation could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
