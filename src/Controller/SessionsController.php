<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

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
            'contain' => ['Workouts']
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
    */
    
    public function calendar(){
        $sessions = $this->Sessions->find('all');
        $this->set('sessions', $sessions);
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
    
    public function addgroup()
    {
        $session = $this->Sessions->newEntity();
        if ($this->request->is('post')) {
            //Obtenemos los registros posible para guardar.
            $data = $this->getDataRange();
            
            $entities = $this->Sessions->newEntities($data);
            foreach ($entities as $entity) {
                // Save entity
                $this->Sessions->save($entity);
            }
            $this->Flash->success(__('The session has been saved.'));
            return $this->redirect(['action' => 'index']);
           
        }
        $this->set(compact('session'));
        $this->set('_serialize', ['session']);
    }

    protected function getDataRange(){
        
        //Montamos el Array data para guardar todas las entity de sessiones
        $start_date = $this->request->data['start_date'];
        $end_date = $this->request->data['end_date'];
        
        $start = strtotime($start_date['year'] . '-' . $start_date['month'] . '-' . $start_date['day']);
        $end = strtotime($end_date['year'] . '-' . $end_date['month'] . '-' . $end_date['day']);
        
        //Recorremos la diferencia de días para crear las entidades para las sesiones.
        $data = [];
        for($i=$start; $i<=$end; $i+=86400){
                $dia_sem = date('w', $i);
                $year = date("Y", $i);
                $month = date("m", $i);
                $day = date("d", $i);
                
                $valido = false;
                switch ($dia_sem){
                    case '0':
                        $valido = ($this->request->data['D'] == 1)?true:false;
                    break;
                    case '1':
                        $valido = ($this->request->data['L'] == 1)?true:false;
                    break;
                    case '2':
                        $valido = ($this->request->data['M'] == 1)?true:false;
                    break;
                    case '3':
                        $valido = ($this->request->data['X'] == 1)?true:false;
                    break;
                    case '4':
                        $valido = ($this->request->data['J'] == 1)?true:false;
                    break;
                    case '5':
                        $valido = ($this->request->data['V'] == 1)?true:false;
                    break;
                    case '6':
                        $valido = ($this->request->data['S'] == 1)?true:false;
                    break;
                }
                
                if ($valido){
                    $aux = [
                        'date' => [
                    		'year' => $year,
                    		'month' => $month,
                    		'day' => $day
                    	],
                    	'start' => $this->request->data['start'],
                    	'end' => $this->request->data['end'],
                    	'max_users' => $this->request->data['max_users']
                    ];
                    
                    array_push($data, $aux);
                }
        }
        
        //debug($data);
        //exit;
        
        return $data;
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
            
            
            //Convertimos la fecha en formato yyyy/mm/dd
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
