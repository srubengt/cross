<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\PeriodForm;
use Cake\Routing\Router;
use Cake\I18n\Time;
use Cake\Validation\Validator;

/**
 * Sessions Controller
 *
 * @property \App\Model\Table\SessionsTable $Sessions
 */
class SessionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function isAuthorized($user)
    {
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
            'contain' => ['Workouts'],
            'order' => ['Sessions.date' => 'desc', 'Sessions.start' => 'asc']
        ];
        
        $sessions = $this->paginate($this->Sessions);
        
        //envío a index.ctp
        $this->set('small_text', 'Listado de Sesiones');
        $this->set('title_layout', 'Sesiones');
        $this->set(compact('sessions')); //pasamos el array de los datos junto al de las sessiones
        $this->set('_serialize', ['sessions']);
       
    }
    
    
    /**
     * calendar method
     * 
     * Otra forma de mostrar las sesiones creadas. En un calendario de manera gráfica.
     * 
    */
    
    public function calendar(){
        
        $sessions = $this->Sessions->find('all');

        $events = $this->getEvents($sessions);
        $this->set('sessions', $sessions);
        $this->set('events', json_encode($events));
    }
    
    
    /**
     * Devuelve un array con los eventos en formato adaptado para el plugin fullcalendar
    */
    protected function getEvents($sess){
        $events = []; 
        foreach ($sess as $session){
            $aux = [
                "id" => $session->id,
                "title" => $session->name,
                "start" => $session->date->i18nFormat('yyyy-MM-dd') . " " . $session->start->i18nFormat('HH:mm:ss'),
                "end" => $session->date->i18nFormat('yyyy-MM-dd') . " " . $session->end->i18nFormat('HH:mm:ss'),
                "url" => Router::url(['controller' => 'Sessions', 'action' => 'view', $session->id])
            ];
            
            array_push($events, $aux);
        }
        
        return $events;
    }
    
    public function viewday($d, $m, $y){
        
        $date = $d.'-'.$m.'-'.$y;
        $fecha = Time::parseDate($date);
        
        
        $q = $this->Sessions->find()
            ->where(['Sessions.date' => $fecha])
            ->order(["Sessions.start"])
        ;

        //ERROR: Falta ejecutar la iteración de la consulta antes de llamar a la view
        $this->set('sessions',$q);

    }
    
    /**
     * View method
     *
     * @param string|null $id Session id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $session = $this->Sessions->get($id, [
            'contain' => ['Workouts', 'Reservations.Users']
        ]);
        
        $query = $this->Sessions->Reservations->find('all', [
                'conditions' => ['Reservations.session_id' => $id]
            ]);
            
        $reservas = $query->count();
        $lista_espera = ($reservas > $session->max_users) ? $reservas - $session->max_users  : 0;
        
        $this->set('reservas', $reservas);
        $this->set('lista_espera', $lista_espera);
        $this->set('session', $session);
        $this->set('_serialize', ['session']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->Sessions->newEntity();
        if ($this->request->is('post')) {
            //debug($this->request->data);
            $session = $this->Sessions->patchEntity($session, $this->request->data);
            //debug($session);
            //die();
            if ($this->Sessions->save($session)) {
                $this->Flash->success(__('The session has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The session could not be saved. Please, try again.'));
            }
        }
        $workouts = $this->Sessions->Workouts->find('list', ['limit' => 200]);
        $this->set(compact('session', 'workouts'));
        $this->set('_serialize', ['session']);
    }
    
    public function period()
    {
        //Creamos un nuevo formulario para los periodos de sesiones
        $period = new PeriodForm();

        if ($this->request->is('post')) {
            $data2 = $period->execute($this->request->data);
            if ($data2) {
                $entities = $this->Sessions->newEntities($data2);
                foreach ($entities as $entity) {
                    // Save entity
                    $this->Sessions->save($entity);
                }

                $this->Flash->success(__('The sessions has been saved.'));
                return $this->redirect(['action' => 'index']);

            } else {
                if (empty($data2)){
                    //El array está vacío, por lo que no se generará ninguna sessión.
                    $this->Flash->error('No se han generado sessiones');
                }else {
                    $errors = $period->errors();
                    $period->setErrors($errors);
                }
            }
        }

        $this->set('period', $period);
    }

    
    /**
     * Edit method
     *
     * @param string|null $id Session id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->Sessions->get($id, [
            'contain' => []
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {

            $session = $this->Sessions->patchEntity($session, $this->request->data);
            if ($this->Sessions->save($session)) {
                $this->Flash->success(__('The session has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The session could not be saved. Please, try again.'));
            }
        }
        $workouts = $this->Sessions->Workouts->find('list', ['limit' => 200]);
        $this->set(compact('session', 'workouts'));
        $this->set('_serialize', ['session']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Session id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $session = $this->Sessions->get($id);
        if ($this->Sessions->delete($session)) {
            $this->Flash->success(__('The session has been deleted.'));
        } else {
            $this->Flash->error(__('The session could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
}
