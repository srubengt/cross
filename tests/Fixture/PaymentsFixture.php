<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PaymentsFixture
 *
 */
class PaymentsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'Id Usuario', 'precision' => null, 'autoIncrement' => null],
        'rate_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'Id tarifa', 'precision' => null, 'autoIncrement' => null],
        'month_payment' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'Mes del pago', 'precision' => null, 'autoIncrement' => null],
        'year_payment' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'Año del pago', 'precision' => null, 'autoIncrement' => null],
        'amount' => ['type' => 'decimal', 'length' => 10, 'precision' => 0, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'Importe'],
        'discount' => ['type' => 'decimal', 'length' => 10, 'precision' => 0, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'Descuento aplicado'],
        'igic' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '7', 'comment' => 'Impuesto aplicado', 'precision' => null, 'autoIncrement' => null],
        'total' => ['type' => 'decimal', 'length' => 10, 'precision' => 0, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'Total a pagar'],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
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
            'user_id' => 1,
            'rate_id' => 1,
            'month_payment' => 1,
            'year_payment' => 1,
            'amount' => 1.5,
            'discount' => 1.5,
            'igic' => 1,
            'total' => 1.5
        ],
    ];
}
