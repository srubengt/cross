<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Result Entity.
 *
 * @property int $id
 * @property int $sessions_users_id
 * @property \App\Model\Entity\SessionsUser $sessions_user
 * @property \App\Model\Entity\ExercisesResult[] $exercises_results
 * @property \App\Model\Entity\Exercise[] $exercises
 */
class Result extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
