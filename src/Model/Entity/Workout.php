<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Workout Entity.
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $photo_results
 * @property \Cake\I18n\Time $date
 * @property \App\Model\Entity\ExercisesWorkout[] $exercises_workouts
 * @property \App\Model\Entity\Exercise[] $exercises
 * @property \App\Model\Entity\WodsWorkout[] $wods_workouts
 * @property \App\Model\Entity\Wod[] $wods
 * @property \App\Model\Entity\Session[] $sessions
 */
class Workout extends Entity
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
