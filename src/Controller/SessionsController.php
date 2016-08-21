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
        //Return 
        return parent::isAuthorized($user);
    } 
    
    public function index()
    {

        $search = '';

        $query = $this->Sessions->find('all',[
            'order' => ['Sessions.date' => 'asc', 'Sessions.start' => 'asc']
        ]);

        if ($this->request->is('post')) {
            $search = $this->request->data['search'];
            if ($search) {
                $query->where(['Sessions.name LIKE' => '%' . $search . '%']);
            }
        }

        $sessions = $this->paginate($query);
        
        //envío a index.ctp
        $this->set('search', $search);
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
        //$events = $this->getEvents($sessions);
        $this->set('sessions', $sessions);
        //$this->set('events', json_encode($events));
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

    public function events(){

        //INFORMACIÓN ENVIADA:

        //view month
        //'start' => '2016-08-01',
        //'end' => '2016-09-12'

        //view day
        //'start' => '2016-08-01',
        //'end' => '2016-08-02'

        $start = new Time($this->request->data('start')); //Fecha inicio
        $end = new Time($this->request->data('end')); //Fecha Fin

        $this->autoRender = false; //No renderiza mediante fichero .ctp
        if ($this->request->is('ajax')){
            //Si la petición es ajax, entrará
            //Obtenemos los eventos correspondidos entre las fechas start y end

            $sessions = $this->Sessions->find('all')
                ->contain(['Workouts'])
                ->where([
                    'Sessions.date >=' => $start,
                    'Sessions.date <=' <= $end,
                ])
                ;

            $events = [];
            foreach ($sessions as $session){
                if ($session->workout_id){
                    $className = 'bg-green';
                    $title = $session->name .' ' . $session->workout->date->i18nFormat('dd/MM/yyyy');
                }else{
                    $className = '';
                    $title = $session->mane;
                }

                $aux = [
                    "id" => $session->id,
                    "title" => $title,
                    "start" => $session->date->i18nFormat('yyyy-MM-dd') . " " . $session->start->i18nFormat('HH:mm:ss'),
                    "end" => $session->date->i18nFormat('yyyy-MM-dd') . " " . $session->end->i18nFormat('HH:mm:ss'),
                    "url" => Router::url(['controller' => 'Sessions', 'action' => 'view', $session->id]),
                    "className" => $className
                ];

                array_push($events, $aux);
            }

            echo json_encode($events);
        };
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


    public function query(){
        $start = new Time('2016-08-01'); //Fecha inicio
        $end = new Time('2016-09-12'); //Fecha Fin



        $this->autoRender = false; //No renderiza mediante fichero .ctp

        $sessions = $this->Sessions->find()
            ->contain(['Workouts'])
            ->where([
                'Sessions.date >=' => $start,
                'Sessions.date <=' <= $end,
            ])
        ;

        $events = [];
        foreach ($sessions as $session){
            if ($session->workout_id){
                $className = 'bg-green';
            }else{
                $className = '';
            }

            $aux = [
                "id" => $session->id,
                "title" => $session->name,
                "start" => $session->date->i18nFormat('yyyy-MM-dd') . " " . $session->start->i18nFormat('HH:mm:ss'),
                "end" => $session->date->i18nFormat('yyyy-MM-dd') . " " . $session->end->i18nFormat('HH:mm:ss'),
                "url" => Router::url(['controller' => 'Sessions', 'action' => 'view', $session->id]),
                "className" => $className
            ];

            array_push($events, $aux);
        }



        debug($events->toArray());

    }
    
}
