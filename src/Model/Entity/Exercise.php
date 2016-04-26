<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Exercise Entity.
 *
 * @property int $id
 * @property string $name
 * @property bool $type_cardio
 * @property bool $type_strenght
 * @property bool $track_distance
 * @property bool $track_resistance
 * @property bool $track_weight
 * @property string $created
 * @property string $modified
 * @property \App\Model\Entity\Result[] $results
 * @property \App\Model\Entity\Wod[] $wods
 * @property \App\Model\Entity\Workout[] $workouts
 */
class Exercise extends Entity
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
