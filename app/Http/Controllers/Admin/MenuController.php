<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;

class MenuController extends ModuleController
{
    protected $moduleName = 'menus';

    protected $titleColumnKey = 'date';

    protected $indexOptions = [
        'permalink' => false,
        'skipCreateModal' => true,
        'editInModal' => false,
        'create' => true,
    ];
}
