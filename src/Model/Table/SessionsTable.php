<?php
namespace App\Model\Table;

use App\Model\Entity\Session;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

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
        $this->displayField('id');
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
    
    
    public function beforeSave($event, $entity, $options)
    {
        
        if ($entity->isNew()){ //Nuevo registro
        
            //Field Workout_id
            if (!$entity->workout_id){
                $entity->workout_id = null;    
            }
            
        }else{ //Editar registro
            
        }
        
        return true;
    }
    
    public function beforeFind($event, $entity, $options){
        //debug($entity);
        //exit;
    }
    
    public function beforeRules($event, $entity, $options, $operation){
        //debug($entity);
        //exit;
    }
    
    public function beforeMarshal( $event,  $data,  $options){
        //Si la fecha enviada no es un array, hacemos una modificación de los datos para convertirlos.
       
        if (!is_array($data['date'])){ 
            $timestamp = strtotime(str_replace('/', '-', $data['date']));
            $year = date("Y", $timestamp);
            $month = date("m", $timestamp);
            $day = date("d", $timestamp);
            
            $data['date'] = [
                    'year' => $year,
                    'month' => $month,
                    'day' => $day
                ];
        }
        
        if (!is_array($data['start'])){ 
            $timestamp = strtotime($data['start']);
            
            $data['start'] = [
                    'hour' =>  date("H", $timestamp),
                    'minute' =>  date("i", $timestamp)
                ];
        }
        
        if (!is_array($data['end'])){ 
            $timestamp = strtotime($data['end']);
            
            $data['end'] = [
                    'hour' =>  date("H", $timestamp),
                    'minute' =>  date("i", $timestamp)
                ];
        }
        
        
        return true;
    }
}
