<?php
namespace App\Model\Table;

use App\Model\Entity\Exercise;
use Cake\ORM\Query;
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

        $this->belongsToMany('Results', [
            'foreignKey' => 'exercise_id',
            'targetForeignKey' => 'result_id',
            'joinTable' => 'exercises_results'
        ]);
        $this->belongsToMany('Wods', [
            'foreignKey' => 'exercise_id',
            'targetForeignKey' => 'wod_id',
            'joinTable' => 'exercises_wods'
        ]);
        $this->belongsToMany('Workouts', [
            'foreignKey' => 'exercise_id',
            'targetForeignKey' => 'workout_id',
            'joinTable' => 'exercises_workouts'
        ]);


        // Add the behaviour and configure any options you want
        $this->addBehavior('Proffer.Proffer', [
            'photo' => [    // The name of your upload field
                'root' => WWW_ROOT . 'files', // Customise the root upload folder here, or omit to use the default
                'dir' => 'photo_dir',   // The name of the field to store the folder
                'thumbnailSizes' => [ // Declare your thumbnails
                    'square' => [   // Define the prefix of your thumbnail
                        'w' => 200, // Width
                        'h' => 200, // Height
                        'crop' => true,  // Crop will crop the image as well as resize it
                        'jpeg_quality'  => 100,
                        'png_compression_level' => 9
                    ],
                    'portrait' => [     // Define a second thumbnail
                        'w' => 100,
                        'h' => 300
                    ],
                ],
                'thumbnailMethod' => 'imagick'  // Options are Imagick, Gd or Gmagick
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
            ->boolean('type_cardio')
            ->allowEmpty('type_cardio');

        $validator
            ->boolean('type_strenght')
            ->allowEmpty('type_strenght');

        $validator
            ->boolean('track_distance')
            ->allowEmpty('track_distance');

        $validator
            ->boolean('track_resistance')
            ->allowEmpty('track_resistance');

        $validator
            ->boolean('track_weight')
            ->allowEmpty('track_weight');

        return $validator;
    }
}
