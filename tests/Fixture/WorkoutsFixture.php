<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * WorkoutsFixture
 *
 */
class WorkoutsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'description' => ['type' => 'text', 'length' => 4294967295, 'null' => true, 'default' => null, 'comment' => 'Explicación del WorkOut de las sesiones de una fecha concreta', 'precision' => null],
        'warmup' => ['type' => 'text', 'length' => 4294967295, 'null' => true, 'default' => null, 'comment' => 'Calentamiento del entreno', 'precision' => null],
        'strenght' => ['type' => 'text', 'length' => 4294967295, 'null' => true, 'default' => null, 'comment' => 'Entrenamiento de Fuerza dentro del WorkOut', 'precision' => null],
        'wod' => ['type' => 'text', 'length' => 4294967295, 'null' => true, 'default' => null, 'comment' => 'Wod principal del Workout', 'precision' => null],
        'photo' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => 'nombre de la imagen del workout', 'precision' => null, 'fixed' => null],
        'photo_dir' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => 'Ruta ubicación de la imagen', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'name_UNIQUE' => ['type' => 'unique', 'columns' => ['name'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'warmup' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'strenght' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'wod' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'photo' => 'Lorem ipsum dolor sit amet',
            'photo_dir' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-06-30 16:31:56',
            'modified' => '2016-06-30 16:31:56'
        ],
    ];
}
