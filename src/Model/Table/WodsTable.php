<?php
namespace App\Model\Table;

use App\Model\Entity\Wod;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Wods Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Scores
 * @property \Cake\ORM\Association\BelongsToMany $Exercises
 * @property \Cake\ORM\Association\BelongsToMany $Workouts
 */
class WodsTable extends Table
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

        $this->table('wods');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Scores', [
            'foreignKey' => 'score_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsToMany('Exercises', [
            'foreignKey' => 'wod_id',
            'targetForeignKey' => 'exercise_id',
            'joinTable' => 'exercises_wods',
            'through' => 'ExercisesWods'
        ]);

        $this->hasMany('ExercisesWods',[
            'foreignKey' => 'wod_id',
            'jointType' => 'INNER',
            'dependent' => true,
            'cascadeCallbacks' => true

        ]);


        $this->belongsToMany('Workouts', [
            'foreignKey' => 'wod_id',
            'targetForeignKey' => 'workout_id',
            'joinTable' => 'wods_workouts'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->allowEmpty('description');

        $validator
            ->integer('rounds')
            ->requirePresence('rounds', 'create')
            ->notEmpty('rounds');

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
        $rules->add($rules->existsIn(['score_id'], 'Scores'));
        return $rules;
    }
}
