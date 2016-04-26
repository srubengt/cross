<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExercisesResult Entity.
 *
 * @property int $id
 * @property int $reservation_id
 * @property \App\Model\Entity\Reservation $reservation
 * @property int $exercises_workouts_id
 * @property \App\Model\Entity\ExercisesWorkout $exercises_workout
 * @property int $reps
 * @property int $weight
 * @property \Cake\I18n\Time $duration
 * @property string $distance
 * @property int $resistance
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\Result $result
 * @property \App\Model\Entity\Exercise $exercise
 */
class ExercisesResult extends Entity
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
