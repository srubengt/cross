<?php
// in src/Form/ContactForm.php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;
use Cake\I18n\Time;

class PeriodForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {

        return $schema
            ->addField('name', 'string')
            ->addField('activity_id', 'integer')
            ->addField('date_start', 'date')
            ->addField('date_end', 'date')
            ->addField('L', 'bool')
            ->addField('M', 'bool')
            ->addField('X', 'bool')
            ->addField('J', 'bool')
            ->addField('V', 'bool')
            ->addField('S', 'bool')
            ->addField('D', 'bool')
            ->addField('start','time')
            ->addField('end', 'time')
            ->addField('max_users', 'integer')
            ;
    }

    protected function _buildValidator(Validator $validator)
    {
        $validator
            ->requirePresence('name', 'Campo requerido.')
            ->notEmpty('name', 'El campo no puede estar vacío.');

        $validator
            ->integer('activity_id')
            ->requirePresence('activity_id', 'Campo Requerido', 'true')
            ->notEmpty('activity_id', 'El campo no puede estar vacío.');

        $validator
            ->notEmpty('date_start', 'El campo no puede estar vacío.');

        $validator
            ->notEmpty('date_end', 'El campo no puede estar vacío.')
            ->add('date_end', 'custom', [
                'rule' => function($value, $context) {
                    $fin = strtotime($value);
                    $inicio = strtotime($context['data']['date_start']);
                    if($inicio >= $fin){
                        return true;
                    }else{
                        return false;
                    }
                },
                'message' => 'La fecha no puede ser menor']);

        $validator
            ->time('start')
            ->requirePresence('start', 'Campo Requerido.', 'true')
            ->notEmpty('start', 'El campo no puede estar vacío.');

        $validator
            ->time('end')
            ->requirePresence('end', 'Campo Requerido.', 'true')
            ->notEmpty('end', 'El campo no puede estar vacío.');

        $validator
            ->integer('max_users')
            ->requirePresence('max_users', 'Campo Requerido', 'true')
            ->notEmpty('max_users', 'El campo no puede estar vacío.');

        return $validator;
    }

    protected function _execute(array $data)
    {
        //Obtenemos las fecha inicio y fin del periodo.
        $begin = Time::parseDate($data['date_start']);
        $end = Time::parseDate($data['date_end']);

        $interval = date_diff($begin, $end);


        //Recorremos la diferencia de días para crear las entidades para las sesiones.
        $data2 = [];
        for($i=0; $i<=$interval->days; $i++){
            if ($i != 0) {
                $begin->modify('+1 day');
            }

            $dia_sem = date('w', $begin->toUnixString());
            $year = $begin->year;
            $month = $begin->month;
            $day = $begin->day;

            $valido = false;
            switch ($dia_sem){
                case '0':
                    $valido = ($data['D'] == 1)?true:false;
                    break;
                case '1':
                    $valido = ($data['L'] == 1)?true:false;
                    break;
                case '2':
                    $valido = ($data['M'] == 1)?true:false;
                    break;
                case '3':
                    $valido = ($data['X'] == 1)?true:false;
                    break;
                case '4':
                    $valido = ($data['J'] == 1)?true:false;
                    break;
                case '5':
                    $valido = ($data['V'] == 1)?true:false;
                    break;
                case '6':
                    $valido = ($data['S'] == 1)?true:false;
                    break;
            }

            if ($valido){
                $aux = [
                    'name' => $data['name'],
                    'activity_id' => $data['activity_id'],
                    'date' => [
                        'year' => $year,
                        'month' => $month,
                        'day' => $day
                    ],
                    'start' => $data['start'],
                    'end' => $data['end'],
                    'max_users' => $data['max_users']
                ];

                array_push($data2, $aux);
            }
        }
        return $data2;
    }


    public function setErrors($errors)
    {
        $this->_errors = $errors;
    }

    public function comparaFechas($fecha1, $fecha2){
        $inicio = strtotime($fecha1);
        $fin = strtotime($fecha2);
        if($inicio >= $fin){
            return true;
        }else{
            return false;
        }
    }
}