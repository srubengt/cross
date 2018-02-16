<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;

class PaymentsShell extends Shell
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Payments');
    }

    public function setTotales(){

        $payments = $this->Payments->find('all');

        foreach ($payments as $key => $item) {
            $payment = $this->Payments->get($item->id);
            $payment->total = $payment->amount + $payment->total_igic;
            $this->Payments->save($payment);

        }
    }
}