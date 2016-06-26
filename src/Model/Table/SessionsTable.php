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

    
}
