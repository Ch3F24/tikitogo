<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class OptionController extends ModuleController
{
    protected $moduleName = 'options';

    protected $indexOptions = [
        'permalink' => false
    ];

    protected $browserColumns = [
        'title' => [
            'title' => 'Title',
            'field' => 'title',
        ],
        'gross_price' => [
            'title' => 'Gross Price',
            'field' => 'gross_price'
        ],
    ];

    protected $indexColumns = [
        'title' => [
            'title' => 'Title',
            'field' => 'title',
        ],
        'price' => [
            'title' => 'Gross Price',
            'field' => 'gross_price'
        ]
    ];

}
