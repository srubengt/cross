<?php
namespace App\Model\Table;

use App\Model\Entity\Session;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Date;
use Cake\I18n\Time;

/**
 * Sessions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Workouts
 * @property \Cake\ORM\Association\HasMany $Reservations
 */
class SessionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('sessions');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Workouts', [
            'foreignKey' => 'workout_id',
            'joinType' => 'LEFT'
        ]);
        $this->hasMany('Reservations', [
            'foreignKey' => 'session_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->notEmpty('name')
            ->requirePresence('name', 'create');
            
        $validator
            ->notEmpty('date');
            
        $validator
            ->notEmpty('date_start');
        
        $validator
            ->time('start')
            ->requirePresence('start', 'create')
            ->notEmpty('start');

        $validator
            ->time('end')
            ->requirePresence('end', 'create')
            ->notEmpty('end');

        $validator
            ->integer('max_users')
            ->requirePresence('max_users', 'create')
            ->notEmpty('max_users');

        return $validator;
    }

    public function validationPeriod($validator)
    {
        $validator
            ->add('name', 'notEmpty', [
                'rule' => 'notEmpty',
                'message' => __('You need to provide a name'),
            ]);
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['workout_id'], 'Workouts'));
        return $rules;
    }
    
    public function createPeriod($data) 
    {
        debug($data);
        exit;
        
        //Obtenemos las fecha inicio y fin del periodo.
        $begin = strtotime(Time::parseDate($data['date_start']));
        $end = strtotime(Time::parseDate($data['date_end']));
        echo $begin;
        die();
        
        //Recorremos la diferencia de días para crear las entidades para las sesiones.
        $data = [];
        for($i=$begin; $i<=$end; $i+=86400){
                $dia_sem = date('w', $i);
                $year = date("Y", $i);
                $month = date("m", $i);
                $day = date("d", $i);
                
                $valido = false;
                switch ($dia_sem){
                    case '0':
                        $valido = ($ata['D'] == 1)?true:false;
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
                        'date' => [
                    		'year' => $year,
                    		'month' => $month,
                    		'day' => $day
                    	],
                    	'start' => $data['start'],
                    	'end' => $data['end'],
                    	'max_users' => $data['max_users']
                    ];
                    
                    array_push($data, $aux);
                }
        }
        //return $data;
        debug($data);
        die();
    }
    
    
   /* protected function getDataRange(){
        
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
        
        return $data;
    }*/
    
}
