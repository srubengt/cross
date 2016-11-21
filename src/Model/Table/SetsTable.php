<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sets Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Results
 *
 * @method \App\Model\Entity\Set get($primaryKey, $options = [])
 * @method \App\Model\Entity\Set newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Set[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Set|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Set patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Set[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Set findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SetsTable extends Table
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

        $this->table('sets');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Results', [
            'foreignKey' => 'result_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Details', [
            'foreignKey' => 'detail_id'
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
            ->integer('distance')
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
        $rules->add($rules->existsIn(['result_id'], 'Results'));

        return $rules;
    }
}
