<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\Core\Configure;
use Cake\I18n\Time;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

use App\Utility\NifCifNie;

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

        $this->hasMany('Dropins', [
            'foreignKey' => 'user_id'
        ]);

        $this->hasMany('Partners', [
            'foreignKey' => 'user_id'
        ]);

        $this->hasMany('Payments', [
            'foreignKey' => 'user_id'
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
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->integer('idcard_type')
            ->allowEmpty('idcard_type');

        $validator
            ->maxLength('idcard', 10)
            ->allowEmpty('idcard');

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

        $validator
            ->allowEmpty('is_dropin');

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
        $rules->add($rules->isUnique(['is_dropin']));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        $rules->add(function ($entity, $options){

            if ($entity['idcard'] != ''){
                return $this->validarDocument($entity);
            }else{
                return true;
            }

        },'isvalididcard', [
            'errorField' => 'idcard',
            'message' => 'Campo no válido'
        ]);

        return $rules;
    }


    public function beforeSave($event,$entity){

        if (!$entity->email){
            $entity->email = null;
        }

        if (!$entity->is_dropin){
            $entity->is_dropin = null;
        }
    }


    //Functions for Validation

    public function validarDocument($entity)
    {
        $obj = new NifCifNie;

        switch ($entity['idcard_type']){
            case 1: //NIF
                return $obj->isValidNIF($entity['idcard']);
                break;
            case 2: //NIE
                return $obj->isValidNIE($entity['idcard']);
                break;
        }
    }



    public function findMonthly(Query $query, array $options)
    {
        //Todos los usuarios que tengan tarifa activa.

        $days = cal_days_in_month(CAL_GREGORIAN, $options['month'], $options['year']);

        $time = new Time($days . '-' . $options['month'] . '-' . $options['year']);

        $payments = TableRegistry::get('Payments');
        $ids = $payments->find('all')
            ->select(['user_id'])
            ->where([
                'Payments.month_payment' => $options['month'],
                'Payments.year_payment' => $options['year']
            ])
            ;



        $query
            ->select([
                'id',
                'name',
                'last_name'
            ])
            ->order(['name' => 'ASC'])
            ->contain([
                'Payments' => function (\Cake\ORM\Query $query) use ($options) {
                    return $query
                        ->where([
                            'Payments.month_payment' => $options['month'],
                            'Payments.year_payment' => $options['year']
                        ])
                        ;
                },
                'Partners' => function ($q) {
                    return $q->formatResults(function (\Cake\Collection\CollectionInterface $partners){
                        return $partners->map(function ($partner){
                            if ($partner->active)
                            {
                                return $partner;
                            }
                        });
                    });
                },
                'Reservations' => function ($q) use ($options, $time) { //Reservas Mes anterior
                    return $q->formatResults(function (\Cake\Collection\CollectionInterface $reservations) use ($options, $time) {
                        return $reservations->map(function ($reserv) use ($options, $time) {
                            if (($reserv['created']->year == $time->year) && ($reserv['created']->month == $time->month))
                            {
                                return $reserv;
                            }
                        });
                    });
                }


            ])
            ->matching('Partners', function ($q) use ($time, $ids) {
                return $q
                    ->where([
                        'Partners.active' => true,
                        'Partners.date_start <=' => $time
                    ])
                    ->orWhere(function($exp, $q) use ($ids){
                        return $exp->in('Partners.user_id', $ids);
                    });
            });

        $query->distinct();

        return $query;
    }



}
