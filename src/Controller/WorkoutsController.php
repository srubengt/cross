<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\RelatedForm;
use Cake\I18n\Time;
use Cake\Utility\Hash;

/**
 * Workouts Controller
 *
 * @property \App\Model\Table\WorkoutsTable $Workouts
 */
class WorkoutsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */

    public function index()
    {
        $workouts = $this->paginate($this->Workouts->find('all'));

        $this->set('small_text', 'Listado de Workouts');
        $this->set('title_layout', 'Workouts');
        $this->set(compact('workouts'));
        $this->set('_serialize', ['workouts']);
    }


    /**
     * View method
     *
     * @param string|null $id Workout id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $workout = $this->Workouts->get($id, [
            'contain' => ['Exercises', 'WodsWorkouts.Wods', 'Sessions']
        ]);

        //Obtenemos todas las fechas de las sessiones disponibles.
        $sessions = $this->Workouts->Sessions->find();
        $sessions
            ->select(['date'])
            ->distinct(['Sessions.date']);
        ;

        $this->set('workout', $workout);
        $this->set('sessions', $sessions);
        $this->set('_serialize', ['workout']);
    }

    /**
     * Select method
     *
     * Selecciona el methot add or edit si para la fecha seleccionada existe o no un workout.
     */

    public function selectAction(){
        //Obtenemos la fecha pasada por Get
        if ($this->request->params['pass']){
            $fecha = new Time($this->request->params['pass'][0]); //Fecha workout

            //Consultamos si existe algún workout para la fecha pasada.
            $q = $this->Workouts->find()
                ->select(['Workouts.id'])
                ->where(['Workouts.date' => $fecha])
            ;

            $workout = $q->toArray(); //Ejecutamos la consulta

            if ($workout){
                //Edit Workout
                $this->redirect(['controller' => 'workouts', 'action' => 'edit', $workout['0']['id']]);
            }else{
                //Add Workout
                $this->redirect(['controller' => 'workouts', 'action' => 'add', $this->request->params['pass'][0]]);
            }

        }else{
            $this->redirect(['action' => 'add']);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //Obtenemos la fecha pasada por Get
        if ($this->request->params['pass']){
            $fecha = new Time($this->request->params['pass'][0]); //Fecha workout
        }else{
            $fecha = Time::now();
        }

        $workout = $this->Workouts->newEntity();
        if ($this->request->is('post')) {

            $workout = $this->Workouts->patchEntity($workout, $this->request->data);

            if ($this->Workouts->save($workout)) {

                //Obtenemos el id del workout guardado.
                $workout_id = $workout->id;

                //Si ha creado wod strenght creamos el wod en la tabla Wods y lo relacionamos
                if (Hash::check($this->request->data, 'strenght')){
                    $strenght = $this->Workouts->Wods->newEntity();
                    $strenght->name = 'Workout (' . $workout->id . ') ' . $workout->date->i18nFormat('dd-MM-yyyy');
                    $strenght->description = $workout->strenght;
                    $strenght->workout_id = $workout_id;
                    $strenght->locked = true;
                    $strenght->type = 0; //El valor actual de los types de wods es 0 -> Strenght/Gymnastic

                    //Guardamos el nuevo wod type -> Strenght/Gymnastic
                    if ($this->Workouts->Wods->save($strenght)){
                        //Obtenemos el id del nuevo wod creado.
                        $strenght_id = $strenght->id;

                        $ww = $this->Workouts->WodsWorkouts->newEntity();
                        $ww->wod_id = $strenght_id;
                        $ww->workout_id = $workout_id;

                        if ($this->Workouts->WodsWorkouts->save($ww)){
                            $this->Flash->success(__('The wod Strenght has been saved.'));
                        }else{
                            //Error al crear la relación Wod Workout, eliminamos el wod
                            $this->Workouts->Wods->delete($strenght);
                            $this->Flash->error(__('The Strenght/Gymnastic Wod could not be saved. Please, try again.'));
                            //Redireccionamos a editar el workout
                            $this->redirect(['controller' => 'workouts', 'action' => 'edit', $workout_id]);
                        }
                    }else{
                        $this->Flash->error(__('The Strenght/Gymnastic Wod could not be saved. Please, try again.'));
                        //Redireccionamos a editar el workout
                        $this->redirect(['controller' => 'workouts', 'action' => 'edit', $workout_id]);
                    }
                }

                //Si ha creado wod metcon creamos el wod en la tabla Wods y lo relacionamos
                if (Hash::check($this->request->data, 'metcon')){
                    $metcon = $this->Workouts->Wods->newEntity();
                    $metcon->name = 'Workout (' . $workout->id . ') ' . $workout->date->i18nFormat('dd-MM-yyyy');
                    $metcon->description = $workout->metcon;
                    $metcon->workout_id = $workout_id;
                    $metcon->locked = true;
                    $metcon->type = 1; //El valor actual de los types de wods es 3 -> MetCon

                    //Guardamos el nuevo wod type -> Strenght/Gymnastic
                    if ($this->Workouts->Wods->save($metcon)){
                        //Obtenemos el id del nuevo wod creado.
                        $metcon_id = $metcon->id;
                        $ww = $this->Workouts->WodsWorkouts->newEntity();
                        $ww->wod_id = $metcon_id;
                        $ww->workout_id = $workout_id;

                        if (!$this->Workouts->WodsWorkouts->save($ww)){
                            //Error al crear la relación Wod Workout, eliminamos el wod
                            $this->Workouts->Wods->delete($metcon);
                            $this->Flash->error(__('The MetCon Wod could not be saved. Please, try again.'));
                            //Redireccionamos a editar el workout
                            $this->redirect(['controller' => 'workouts', 'action' => 'edit', $workout_id]);
                        }
                    }else{
                        $this->Flash->error(__('The MetCon Wod could not be saved. Please, try again.'));
                        //Redireccionamos a editar el workout
                        $this->redirect(['controller' => 'workouts', 'action' => 'edit', $workout_id]);
                    }
                }

                //actualizamos todas las session que contengan la fecha de dicho workout
                $this->loadModel('Sessions');
                $this->Sessions->query()
                    ->update()
                    ->set(['Sessions.workout_id' => $workout->id])
                    ->where(['Sessions.date' => $workout->date])
                    ->execute();


                $this->Flash->success(__('The workout has been saved.'));
                if (Hash::check($this->request->query, 'origen')){
                    switch ($this->request->query['origen']){
                        case 'reserv':
                            $now = new Time($workout->date);
                            return $this->redirect([
                                'controller' => 'reservations',
                                'action' => 'index',
                                $now->day,
                                $now->month,
                                $now->year
                            ]);
                            break;
                        default:
                            return $this->redirect(['controller' => 'sessions','action' => 'calendar']);
                    }
                }else{
                    return $this->redirect(['controller' => 'sessions','action' => 'calendar']);
                }

            } else {
                $this->Flash->error(__('The workout could not be saved. Please, try again.'));
            }
        }else{
            //Asignamos la fecha a la entidad del workout
            $workout->date = $fecha;

            //Comprobamos si para la fecha pasada ya hay asignado un workout
            $q = $this->Workouts->find()
                ->select(['date'])
                ->where(['Workouts.date' => $fecha])
                ;
            if ($q->count() > 0){
                //Para la fecha introducida existe workout asignado, mostramos un error
                //No pueden haber workouts con la misma fecha
                $this->Flash->error(__('Ya existe workout para la fecha introducida. Seleccione otra fecha!'));
            }
        }

        $this->set('fecha', $fecha);
        $this->set(compact('workout'));
        $this->set('_serialize', ['workout']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Workout id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $workout = $this->Workouts->get($id, [
            'contain' => ['Exercises', 'WodsWorkouts.Wods', 'Sessions']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $workout = $this->Workouts->patchEntity($workout, $this->request->data);

            if ($this->Workouts->save($workout)) {

                //actualizamos todas las session que contengan la fecha de dicho workout
                $this->loadModel('Sessions');

                //Eliminamos la relacion de workouts y sessions
                $this->Sessions->query()
                    ->update()
                    ->set(['workout_id' => null])
                    ->where(['workout_id' => $workout->id])
                    ->execute();

                //Relacionamos los workouts y las sessions de la fecha pasada.
                $this->Sessions->query()
                    ->update()
                    ->set(['workout_id' => $workout->id])
                    ->where(['date' => $workout->date])
                    ->execute();

                //comprobamos si existe wod strenght
                if (Hash::check($this->request->data, 'strenght')){
                    if ($this->request->data['strenght_id']){
                        $new = false;
                        //Actualizamos el wod ya existente
                        $strenght = $this->Workouts->Wods->get($this->request->data['strenght_id']);
                        $strenght->description = $workout->strenght;
                    }else{
                        $new = true;
                        $strenght = $this->Workouts->Wods->newEntity(); //Nuevo Wod
                        $strenght->name = 'Workout (' . $workout->id . ') ' . $workout->date->i18nFormat('dd-MM-yyyy');
                        $strenght->description = $workout->strenght;
                        $strenght->workout_id = $workout->id;
                        $strenght->locked = true;
                        $strenght->type = 0; //El valor actual de los types de wods es 0 -> Strenght/Gymnastic
                    }


                    //Guardamos el wod type -> Strenght/Gymnastic
                    if ($this->Workouts->Wods->save($strenght)){
                        if ($new) {
                            //Obtenemos el id del nuevo wod creado.
                            $strenght_id = $strenght->id;

                            $ww = $this->Workouts->WodsWorkouts->newEntity();
                            $ww->wod_id = $strenght_id;
                            $ww->workout_id = $workout->id;

                            if ($this->Workouts->WodsWorkouts->save($ww)) {
                                $this->Flash->success(__('The wod Strenght has been saved.'));
                            } else {
                                //Error al crear la relación Wod Workout, eliminamos el wod
                                $this->Workouts->Wods->delete($strenght);
                                $this->Flash->error(__('The Strenght/Gymnastic Wod could not be saved. Please, try again.'));
                                //Redireccionamos a editar el workout
                                $this->redirect(['controller' => 'workouts', 'action' => 'edit', $workout->id]);
                            }
                        }else{
                            $this->Flash->success(__('The Strenght/Gymnastic Wod has been saved.'));
                        }
                    }else{
                        $this->Flash->error(__('The Strenght/Gymnastic Wod could not be saved. Please, try again.'));
                        //Redireccionamos a editar el workout
                        $this->redirect(['controller' => 'workouts', 'action' => 'edit', $workout->id]);
                    }
                }

                //Si ha creado wod metcon creamos el wod en la tabla Wods y lo relacionamos
                if (Hash::check($this->request->data, 'metcon')){
                    if ($this->request->data['metcon_id'] > 0){
                        $new = false;
                        //Actualizamos el wod ya existente
                        $metcon = $this->Workouts->Wods->get($this->request->data['metcon_id']);
                        $metcon->description = $workout->metcon;
                    }else{
                        $new = true;
                        $metcon = $this->Workouts->Wods->newEntity(); //Nuevo Wod
                        $metcon->name = 'Workout (' . $workout->id . ') ' . $workout->date->i18nFormat('dd-MM-yyyy');
                        $metcon->description = $workout->metcon;
                        $metcon->workout_id = $workout->id;
                        $metcon->locked = true;
                        $metcon->type = 1; //El valor actual de los types de wods es 0 -> Strenght/Gymnastic
                    }

                    //Guardamos el nuevo wod type -> Strenght/Gymnastic
                    if ($this->Workouts->Wods->save($metcon)){
                        if ($new) {
                            //Obtenemos el id del nuevo wod creado.
                            $metcon_id = $metcon->id;
                            $ww = $this->Workouts->WodsWorkouts->newEntity();
                            $ww->wod_id = $metcon_id;
                            $ww->workout_id = $workout->id;

                            if (!$this->Workouts->WodsWorkouts->save($ww)) {
                                //Error al crear la relación Wod Workout, eliminamos el wod
                                $this->Workouts->Wods->delete($metcon);
                                $this->Flash->error(__('The MetCon Wod could not be saved. Please, try again.'));
                                //Redireccionamos a editar el workout
                                $this->redirect(['controller' => 'workouts', 'action' => 'edit', $workout->id]);
                            }
                        }else{
                            $this->Flash->success(__('The MetCon Wod has been saved.'));
                        }
                    }else{
                        $this->Flash->error(__('The MetCon Wod could not be saved. Please, try again.'));
                        //Redireccionamos a editar el workout
                        $this->redirect(['controller' => 'workouts', 'action' => 'edit', $workout->id]);
                    }
                }

                $this->Flash->success(__('The workout has been saved.'));
                if (Hash::check($this->request->query, 'origen')){
                    switch ($this->request->query['origen']){
                        case 'reserv':
                            $now = new Time($workout->date);
                            return $this->redirect([
                                'controller' => 'reservations',
                                'action' => 'index',
                                $now->day,
                                $now->month,
                                $now->year
                            ]);
                            break;
                        default:
                            return $this->redirect(['controller' => 'sessions','action' => 'calendar']);
                    }
                }else{
                    return $this->redirect(['controller' => 'sessions','action' => 'calendar']);
                }

            } else {
                $this->Flash->error(__('The workout could not be saved. Please, try again.'));
            }
        }

        //debug($workout);
        //die();

        $this->set(compact('workout'));
        $this->set('_serialize', ['workout']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Workout id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $workout = $this->Workouts->get($id);
        if ($this->Workouts->delete($workout)) {

            //actualizamos todas las session que contengan la fecha de dicho workout
            $this->loadModel('Sessions');
            $this->Sessions->query()
                ->update()
                ->set(['Sessions.workout_id' => null])
                ->where(['Sessions.date' => $workout->date])
                ->execute();

            $this->Flash->success(__('The workout has been deleted.'));
        } else {
            $this->Flash->error(__('The workout could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }


    public function listWods($workout_id = null, $type = null){

        //Cargamos el modelo de los Wods
        $this->loadModel("Wods");

        //Filtro del paginado
        $search = '';
        $this->paginate = [
            'contain' => ['Scores'],
            'order' => ['Wods.name' => 'asc'],
        ];

        $query = $this->Wods->find();
        if ($this->request->is('post')) {
            $search = $this->request->data['search'];
            if ($search) {
                $query->where(['Wods.name LIKE' => '%' . $search . '%']);
            }
        }

        $workout = $this->Workouts->get($workout_id);

        //enviamos a la vista
        $wods = $this->paginate($query);
        $this->set('search', $search);
        $this->set('type', $type);
        $this->set('workout', $workout);
        $this->set(compact('wods'));
        $this->set('_serialize', ['wods']);

    }

    public function addWod($wod_id = null, $workout_id = null, $type = null){
        /*
         * Función que añade el wod seleccionado a la tabla wods_workouts
         * cumplimentando el campo type, para saber si se trata de un wod Strenght/Gymnastic o MetCon
         *
         * */

        //Asignamos los datos a request data, type [0 - Strenght/Gymnastic, 1 - MetCon]
        $data = [
            'workout_id' => $workout_id,
            'wod_id' => $wod_id,
            'type' => $type
        ];

        if ($this->request->is('post')){
            $wodwork = $this->Workouts->WodsWorkouts->newEntity($data);
            if ($this->Workouts->WodsWorkouts->save($wodwork)) {
                $this->Flash->success(__('The wod has been saved.'));
            } else {
                $this->Flash->error(__('The wod could not be saved. Please, try again.'));
            }
            return $this->redirect(['action' => 'edit', $workout_id]);
        }
    }

    public function deleteWod($id = null){
        //Variables: $id -> WodWorkout->id, $workout_id -> id del workout actual.

        $this->request->allowMethod(['post', 'delete']);
        $wodwork = $this->Workouts->WodsWorkouts->get($id);
        $workout_id = $wodwork->workout_id;

        if ($this->Workouts->WodsWorkouts->delete($wodwork)) {
            $this->Flash->success(__('The wod has been deleted.'));
        } else {
            $this->Flash->error(__('The wod could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'edit', $workout_id]);

    }

    /**
     * Relacionamos el workout actual con las sessions seleccionadas.
    */

    public function relateSession($workout_id = null){
        //Creamos un nuevo formulario para relacionar las sesiones
        $related = new RelatedForm();

        if ($this->request->is('post')) {
            $data2 = $related->execute($this->request->data);
            if ($data2) {
                foreach ($data2 as $item){
                    $session = $this->Workouts->Sessions->get($item['id']);
                    $session = $this->Workouts->Sessions->patchEntity($session, $item);
                    //debug($session);
                    $this->Workouts->Sessions->save($session);
                }

                $this->Flash->success(__('The sessions has been saved.'));
                return $this->redirect(['action' => 'edit', $workout_id]);

            } else {
                if (empty($data2)){
                    //El array está vacío, por lo que no se relacionaran las sessions con el workout
                    $this->Flash->error('No se han relacionado sesiones');
                }else {
                    $errors = $related->errors();
                    $related->setErrors($errors);
                }
            }
        }

        //Obtenemos los datos del workout
        $workout = $this->Workouts->get($workout_id);

        //Obtenemos las sessiones en función de la fecha pasado por parámetro.
        if ($this->request->is('get')) {
            //Obtenemos la fecha enviada.
            $e = $this->request->query;

            if (!empty($e)){
                if (!empty($e['date'])) {
                    $fecha = Time::parseDate($e['date']);
                }else{
                    if (!empty($e['month'])) {
                        $fecha = Time::now();
                        switch($e['month']){
                            case '1':
                                //Incrementamos el año
                                $fecha->day(1);
                                $fecha->month($e['month']);
                                $fecha->year($fecha->year + 1);
                                break;
                            case '12':
                                $fecha->day(1);
                                $fecha->month($e['month']);
                                $fecha->year($fecha->year - 1);
                                break;
                            default:
                                $fecha->day(1);
                                $fecha->month($e['month']);
                        }
                    }else{
                        $fecha = Time::now();
                    }
                }
            }else{
                $fecha = Time::now();
            }
        }else{
            $fecha = Time::now();
        }

        //Según la fecha obtenida, buscamos las sessiones para dicho día.
        $sessions = $this->Workouts->Sessions->find();
        $sessions
            ->where(['Sessions.date' => $fecha])
            ->order('Sessions.start, Sessions.end')
        ;


        //Obtenemos todas las fechas de las sessiones disponibles.
        $q = $this->Workouts->Sessions->find();
        $date = $q->func()->date_format([
            'date' => 'identifier',
            "'%d-%m-%Y'" => 'literal'
        ]);

        $q
            ->select(['date_only' => $date])
            ->distinct(['Sessions.date'])
            ->where(['MONTH(Sessions.date)' => $fecha->month, 'YEAR(Sessions.date)' => $fecha->year]) //Obtenemos las sessiones del mes de la $fecha.
        ;

        $dates =[];
        foreach ($q as $session){
            array_push($dates, $session->date_only);
        }


        $this->set('fecha', $fecha);
        $this->set('sessions', $sessions);
        $this->set('dates', $dates);
        $this->set('workout', $workout);
        $this->set('related', $related);
    }


    public function removeSession(){

        if ($this->request->is('post')) {

            $workout_id = $this->request->params['pass']['0'];
            $session_id = $this->request->params['pass']['1'];

            $session = $this->Workouts->Sessions->get($session_id);
            $session->workout_id = null;

            //$session = $this->Workouts->Sessions->patchEntity($session, $item);
            if ($this->Workouts->Sessions->save($session)) {
                $this->Flash->success(__('The sessions has been removed.'));
                return $this->redirect(['action' => 'edit', $workout_id]);
            } else {
                $this->Flash->error(__('The sessions could not be removed. Please, try again.'));
            }
        }

    }
}
