<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExercisesWod Entity.
 *
 * @property int $id
 * @property int $wod_id
 * @property \App\Model\Entity\Wod $wod
 * @property int $exercise_id
 * @property \App\Model\Entity\Exercise $exercise
 * @property int $set_reps
 * @property int $set_weight
 * @property \Cake\I18n\Time $set_duration
 * @property string $set_distance
 * @property \Cake\I18n\Time $set_resistance
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class ExercisesWod extends Entity
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
