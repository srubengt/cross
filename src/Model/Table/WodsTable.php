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

        $this->belongsToMany('Workouts', [
            'foreignKey' => 'wod_id',
            'targetForeignKey' => 'workout_id',
            'joinTable' => 'wods_workouts'
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
                        //'crop' => true,  // Crop will crop the image as well as resize it
                        //'jpeg_quality'  => 50,
                        //'png_compression_level' => 5
                    ],
                    'portrait' => [// Define a second thumbnail
                        'w' => Configure::read('photo_portrait'),
                        'h' => Configure::read('photo_portrait'),
                        'fit' => true
                    ],
                    'better' => [
                        'w' => Configure::read('photo_better'),
                        'h' => null
                        //'fit' => true
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
            ->allowEmpty('description');

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
        return $rules;
    }
}
