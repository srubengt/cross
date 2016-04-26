<?php
namespace App\Model\Table;

use App\Model\Entity\ExercisesWorkout;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExercisesWorkouts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Workouts
 * @property \Cake\ORM\Association\BelongsTo $Exercises
 */
class ExercisesWorkoutsTable extends Table
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

        $this->table('exercises_workouts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Workouts', [
            'foreignKey' => 'workout_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Exercises', [
            'foreignKey' => 'exercise_id',
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
            ->integer('set_reps')
            ->allowEmpty('set_reps');

        $validator
            ->integer('set_weight')
            ->allowEmpty('set_weight');

        $validator
            ->time('set_duration')
            ->allowEmpty('set_duration');

        $validator
            ->allowEmpty('set_distance');

        $validator
            ->integer('set_resistance')
            ->allowEmpty('set_resistance');

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
        $rules->add($rules->existsIn(['exercise_id'], 'Exercises'));
        return $rules;
    }
}
