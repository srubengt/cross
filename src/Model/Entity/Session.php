<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Session Entity.
 *
 * @property int $id
 * @property \Cake\I18n\Time $start
 * @property \Cake\I18n\Time $end
 * @property int $max_users
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $workout_id
 * @property \App\Model\Entity\Workout $workout
 * @property \App\Model\Entity\Reservation[] $reservations
 */
class Session extends Entity
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
