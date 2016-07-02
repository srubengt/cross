<?php
namespace App\Model\Table;

use App\Model\Entity\Workout;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Workouts Model
 *
 * @property \Cake\ORM\Association\HasMany $Sessions
 * @property \Cake\ORM\Association\BelongsToMany $Exercises
 * @property \Cake\ORM\Association\BelongsToMany $Wods
 */
class WorkoutsTable extends Table
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

        $this->table('workouts');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Sessions', [
            'foreignKey' => 'workout_id'
        ]);
        $this->belongsToMany('Exercises', [
            'foreignKey' => 'workout_id',
            'targetForeignKey' => 'exercise_id',
            'joinTable' => 'exercises_workouts'
        ]);
        $this->belongsToMany('Wods', [
            'foreignKey' => 'workout_id',
            'targetForeignKey' => 'wod_id',
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
            ->notEmpty('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('description');

        $validator
            ->allowEmpty('warmup');

        $validator
            ->allowEmpty('strenght');

        $validator
            ->allowEmpty('wod');

        $validator
            ->allowEmpty('photo');

        $validator
            ->allowEmpty('photo_dir');

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
        $rules->add($rules->isUnique(['name']));
        return $rules;
    }
}
