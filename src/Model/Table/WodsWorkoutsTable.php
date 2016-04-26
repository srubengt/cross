<?php
namespace App\Model\Table;

use App\Model\Entity\WodsWorkout;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WodsWorkouts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Wods
 * @property \Cake\ORM\Association\BelongsTo $Workouts
 */
class WodsWorkoutsTable extends Table
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

        $this->table('wods_workouts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Wods', [
            'foreignKey' => 'wod_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Workouts', [
            'foreignKey' => 'workout_id',
            'joinType' => 'INNER'
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
        $rules->add($rules->existsIn(['wod_id'], 'Wods'));
        $rules->add($rules->existsIn(['workout_id'], 'Workouts'));
        return $rules;
    }
}
