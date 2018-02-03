<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Utility\Hash;
use Cake\Controller\Component\CookieComponent;

/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 */
class PaymentsController extends AppController
{


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
                ->contain(['Users', 'Rates'])
                ->where([
                    'month_payment' => $month,
                    'year_payment' => $year
                ])
        ;

        //Obtengo los totales de Amount, Discount, Igic, Total
        $amount = 0;
        $discount = 0;
        $igic = 0;
        $total = 0;

        foreach ($q as $item) {
            $amount += $item->amount;
            $discount += $item->discount;
            $igic += $item->total_igic;
            $total += $item->total;
        }

        $payments = $this->paginate($q);

        $this->set(compact('payments', 'search', 'year', 'month', 'amount', 'discount', 'igic', 'total'));
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
        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $btime = new Time($days . '-' . $month . '-' . $year);
        $btime->subMonth(1);


        //Obtenemos los usuarios que tienen que pagar la mensualidad a través de un custom finder contra el model Users
        $q = $this->Payments->Users->find('Monthly', ['month' => $month, 'year' => $year]);

        $u_payments = $this->paginate($q);

        $this->set(compact('u_payments', 'rates', 'year', 'month', 'btime'));
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

        $this->set(compact('payment', 'rates'));
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
        $rates = $this->Rates->find('list', ['limit' => 200])->toArray();

        $this->set(compact('payment', 'user', 'month', 'year', 'rates'));
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
        $rates = $this->Rates->find('list', ['limit' => 200])->toArray();

        $this->set(compact('payment','year','month', 'rates'));
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
        $this->request->allowMethod(['post', 'delete']);
        $payment = $this->Payments->get($id);
        if ($this->Payments->delete($payment)) {
            $this->Flash->success(__('The payment has been deleted.'));
        } else {
            $this->Flash->error(__('The payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
