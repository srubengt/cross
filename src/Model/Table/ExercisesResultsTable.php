<?php
namespace App\Model\Table;

use App\Model\Entity\ExercisesResult;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExercisesResults Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Reservations
 * @property \Cake\ORM\Association\BelongsTo $ExercisesWorkouts
 */
class ExercisesResultsTable extends Table
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

        $this->table('exercises_results');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Reservations', [
            'foreignKey' => 'reservation_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ExercisesWorkouts', [
            'foreignKey' => 'exercises_workouts_id',
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

        $validator
            ->integer('reps')
            ->allowEmpty('reps');

        $validator
            ->integer('weight')
            ->allowEmpty('weight');

        $validator
            ->time('duration')
            ->allowEmpty('duration');

        $validator
            ->allowEmpty('distance');

        $validator
            ->integer('resistance')
            ->allowEmpty('resistance');

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
        $rules->add($rules->existsIn(['reservation_id'], 'Reservations'));
        $rules->add($rules->existsIn(['exercises_workouts_id'], 'ExercisesWorkouts'));
        return $rules;
    }
}
