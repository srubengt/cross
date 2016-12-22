<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\Core\Configure;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Roles
 * @property \Cake\ORM\Association\HasMany $Reservations
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Reservations', [
            'foreignKey' => 'user_id',
            'depend' => true,
            'cascadeCallbacks' => true
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
                        'h' => Configure::read('photo_better'),
                        'fit' => true
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
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

        $validator
            ->allowEmpty('photo');

        $validator
            ->allowEmpty('photo_dir');

        $validator
            ->requirePresence('login', 'create')
            ->notEmpty('login')
            ->add('login', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->email('email')
            ->allowEmpty('email')
        ;

        $validator
            ->integer('nivel')
            ->requirePresence('nivel', 'create')
            ->notEmpty('nivel');

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
        $rules->add($rules->isUnique(['login']));
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));
        return $rules;
    }

    public function beforeSave($event,$entity){

        if (!$entity->email){
            $entity->email = null;
        }
    }

}
