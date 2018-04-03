<?php
/**
 * Created by PhpStorm.
 * User: srubengt
 * Date: 3/4/18
 * Time: 9:18
 */

use Cake\Core\Configure;


//tipos de documentos
//Documento employee
Configure::write('Head1', [
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        //'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
    ],
    'borders' => [
        'top' => [
            //'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
    'fill' => [
        //'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
        'rotation' => 90,
        'startColor' => [
            'argb' => 'FFA0A0A0',
        ],
        'endColor' => [
            'argb' => 'FFFFFFFF',
        ],
    ],
]);