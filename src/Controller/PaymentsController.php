<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\I18n\Time;
use Cake\Mailer\Mailer;
use Cake\Utility\Hash;
use Cake\Controller\Component\CookieComponent;

/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 */
class PaymentsController extends AppController
{
    public function isAuthorized($user)
    {
        // All registered users can logout

        switch ($user['role_id']){
            case 5: //Encargado
                switch ($this->request->action){
                    case 'index':
                        return false;
                        break;
                }
                break;
        }

        //  Return
        return parent::isAuthorized($user);
    }


    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Cookie', ['expiry' => '1 day']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $data = $this->request->data();

        if ((Hash::check($data, 'month')) && (Hash::check($data, 'year'))){
            $month = $data['month'];
            $year = $data['year'];

            //Actualizamos o cremos la cookie
            $this->Cookie->write('Payments.month', $month);
            $this->Cookie->write('Payments.year', $year);
        }else{
            if ((!$this->Cookie->read('Payments.year')) && (!$this->Cookie->read('Payments.month'))) {
                $time = new Time();
                $month = $time->month;
                $year = $time->year;
            } else {
                $month = $this->Cookie->read('Payments.month');
                $year = $this->Cookie->read('Payments.year');
            }
        }

        $search = '';

        //Obtenemos los años de los socios
        $years = $this->Payments->find('Years')->toList();

        $results=[];
        foreach ($years as $key => $item) {
            $results[$item['year_payment']] = $item['year_payment'];
        }

        $this->set('years', $results);

        //Compruebo si existe el año seleccionado (posiblemente desde Cookie) en $years
        if (!in_array($year, $results)){
            $time = new Time();
            $year =  $time->year;
            $month = $time->month;
            //Actualizamos o cremos la cookie
            $this->Cookie->write('Payments.month', $month);
            $this->Cookie->write('Payments.year', $year);
        }

        $this->set('months', [
            1 => 'Ene',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Abr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Ago',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dic'
        ]);


        $q = $this->Payments->find('all');

        $q
                ->contain(['Users'])
                ->where([
                    'month_payment' => $month,
                    'year_payment' => $year
                ])
        ;

        //Obtengo los totales de Amount, Discount, Igic, Total
        $amount = 0;
        $igic = 0;
        $total = 0;

        foreach ($q as $item) {
            $amount += $item->amount;
            $igic += $item->total_igic;
            $total += $item->total;
        }


        $this->paginate = [
            'contain' => ['Users']
        ];

        $payments = $this->paginate($q);

        $idcards = Configure::read('IdCards');
        $payments_type = Configure::read('PaymentsType');

        $this->loadModel('Rates');
        $rates = $this->Rates->find('list', ['limit' => 200])->toArray();


        $this->set(compact('payments', 'search', 'year', 'month', 'amount', 'igic', 'total', 'idcards', 'payments_type','rates'));
        $this->set('_serialize', ['payments']);
    }



    /**
     * Monthly method
     *
     * @return \Cake\Network\Response|null
     * Mostramos todos aquellos posibles pagos en función de los usuarios que son Partners y según la tarifa que tengan aplicada.
     */

    public function monthly()
    {

        $data = $this->request->data();

        if ((Hash::check($data, 'month')) && (Hash::check($data, 'year'))){
            $month = $data['month'];
            $year = $data['year'];

            //Actualizamos o cremos la cookie
            $this->Cookie->write('Payments.month', $month);
            $this->Cookie->write('Payments.year', $year);
        }else{
            if ((!$this->Cookie->read('Payments.year')) && (!$this->Cookie->read('Payments.month'))) {
                $time = new Time();
                $month = $time->month;
                $year = $time->year;
            } else {
                $month = $this->Cookie->read('Payments.month');
                $year = $this->Cookie->read('Payments.year');
            }
        }


        //Obtenemos los años de los socios
        $years = $this->Payments->Users->Partners->find('Years')->toList();

        foreach ($years as $key => $item) {
            $results[$item['year']] = $item['year'];
        }
        $this->set('years', $results);

        //Compruebo si existe el año seleccionado (posiblemente desde Cookie) en $years

        if (!in_array($year, $results)){
            $time = new Time();
            $year =  $time->year;
            $month = $time->month;
            //Actualizamos o cremos la cookie
            $this->Cookie->write('Payments.month', $month);
            $this->Cookie->write('Payments.year', $year);
        }

        $this->set('months', [
            1 => 'Ene',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Abr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Ago',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dic'
        ]);

        $this->loadModel('Rates');
        $rates = $this->Rates->find('list', ['limit' => 200])->toArray();


        //Mensualidad Anterio (btime ->BeforeTime)
        /*$days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $btime = new Time($days . '-' . $month . '-' . $year);
        $btime->subMonth(1);*/


        //Obtenemos los usuarios que tienen que pagar la mensualidad a través de un custom finder contra el model Users
        $q = $this->Payments->Users->find('Monthly', ['month' => $month, 'year' => $year]);

        //debug($q->toArray());
        //die();

        $u_payments = $this->paginate($q);

        $this->set(compact('u_payments', 'rates', 'year', 'month'));
        $this->set('_serialize', ['u_payments']);
    }


    /**
     * View method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $payment = $this->Payments->get($id, [
            'contain' => ['Users', 'Users.Partners']
        ]);


        $this->loadModel('Rates');
        $rates = $this->Rates->find('list', ['limit' => 200])->toArray();

        $payments_type = Configure::read('PaymentsType');

        $this->set(compact('payment', 'rates', 'payments_type'));
        $this->set('_serialize', ['payment']);
    }


    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($user_id = null)
    {
        $payment = $this->Payments->newEntity();

        $user = $this->Payments->Users->get($user_id,[
            'contain' => [
                'Partners' => function (\Cake\ORM\Query $query) {
                    return $query
                        ->where(['Partners.active' => true])
                        ;
                }
            ]
        ]);

        $month = $this->Cookie->read('Payments.month');
        $year = $this->Cookie->read('Payments.year');

        if ($this->request->is('post')) {

            $data = $this->request->data;

            $data['month_payment'] = $this->Cookie->read('Payments.month');
            $data['year_payment'] = $this->Cookie->read('Payments.year');

            $payment = $this->Payments->patchEntity($payment, $data);

            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));
                return $this->redirect(['action' => 'monthly']);
            } else {
                $this->Flash->error(__('The payment could not be saved. Please, try again.'));
            }
        }


        $this->loadModel('Rates');
        $rates = $this->Rates->find('list',[
            'keyField' => 'id',
            'valueField' => function ($rate) {
                return $rate->get('name') . ' (' . $rate->get('price') . '€)';
            }
        ])->toArray();

        $q = $this->Rates->find('all');
        $options = [];
        foreach ($q as $item) {
            $option = [
                'text' => $item->name . '(' . $item->price . '€)',
                'value' => $item->id,
                'price' => $item->price
            ];

            array_push($options, $option);
        }

        $idcards = Configure::read('IdCards');
        $payments_type = Configure::read('PaymentsType');

        $this->set(compact('payment', 'user', 'month', 'year', 'rates', 'idcards', 'payments_type','options'));
        $this->set('_serialize', ['payment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $payment = $this->Payments->get($id, [
            'contain' => ['Users', 'Users.Partners']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {


            $payment = $this->Payments->patchEntity($payment, $this->request->data);

            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The payment could not be saved. Please, try again.'));
            }
        }

        $month = $this->Cookie->read('Payments.month');
        $year = $this->Cookie->read('Payments.year');

        $this->loadModel('Rates');
        $rates = $this->Rates->find('list',[
            'keyField' => 'id',
            'valueField' => function ($rate) {
                return $rate->get('name') . ' (' . $rate->get('price') . '€)';
            }
        ])->toArray();

        $q = $this->Rates->find('all');
        $options = [];
        foreach ($q as $item) {
            $option = [
                'text' => $item->name . '(' . $item->price . '€)',
                'value' => $item->id,
                'price' => $item->price
            ];

            array_push($options, $option);
        }

        $idcards = Configure::read('IdCards');
        $payments_type = Configure::read('PaymentsType');

        $this->set(compact('payment','year','month', 'rates', 'idcards', 'payments_type', 'options'));
        $this->set('_serialize', ['payment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $tag = $this->request->query('tag');

        $this->request->allowMethod(['post', 'delete']);

        $payment = $this->Payments->get($id);

        //Usuario encargado que puede eliminar pagos, pero no debe hacerlo si ha pasado un tiempo prudencial
        $role_id = $this->Auth->user('role_id');
        $time = new Time();
        if ($role_id == 5){
            $diff = $time->diff($payment->created);
            if ($diff->h > 1){
                $this->Flash->error(__('No se puede eliminar el pago. Tiempo permitido superado (1 hora)'));
                return $this->redirect(['action' => 'monthly']);
            }
        }

        ////////////////////////

        if ($this->Payments->delete($payment)) {
            $this->Flash->success(__('The payment has been deleted.'));
        } else {
            $this->Flash->error(__('The payment could not be deleted. Please, try again.'));
        }

        switch ($tag){
            case 'monthly':
                return $this->redirect(['action' => 'monthly']);
                break;
            default:
                return $this->redirect(['action' => 'index']);

        }

    }
}
