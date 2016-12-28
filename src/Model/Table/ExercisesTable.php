<?php
namespace App\Model\Table;

use App\Model\Entity\Exercise;
use Cake\ORM\Query;
use Cake\Core\Configure;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Exercises Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Results
 * @property \Cake\ORM\Association\BelongsToMany $Wods
 * @property \Cake\ORM\Association\BelongsToMany $Workouts
 */
class ExercisesTable extends Table
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

        $this->table('exercises');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Details', [
            'foreignKey' => 'detail_id'
        ]);


        // Add the behaviour and configure any options you want
        $this->addBehavior('Proffer.Proffer', [
            'photo' => [    // The name of your upload field
                'root' => WWW_ROOT . 'files', // Customise the root upload folder here, or omit to use the default
                'dir' => 'photo_dir',   // The name of the field to store the folder
                'cleanup' => true, //Eliminina las imagenes antiguas al edit.
                'thumbnailSizes' => [ // Declare your thumbnails
                    'square' => [   // Define the prefix of your thumbnail
                        'w' => Configure::read('photo_square'), // Width
                        'h' => Configure::read('photo_square'), // Height
                        'fit' => true,
                    ],
                    'portrait' => [// Define a second thumbnail
                        'w' => Configure::read('photo_portrait'),
                        'h' => Configure::read('photo_portrait'),
                        'fit' => true
                    ],
                    'better' => [
                        'w' => Configure::read('photo_better'),
                        'h' => null
                    ]
                ],
                'thumbnailMethod' => 'gd'  // Options are Imagick, Gd or Gmagick
            ]
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
            ->allowEmpty('photo');

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
        $rules->add($rules->existsIn(['group_id'], 'Groups'));
        $rules->add($rules->existsIn(['detail_id'], 'Details'));

        return $rules;
    }
}
