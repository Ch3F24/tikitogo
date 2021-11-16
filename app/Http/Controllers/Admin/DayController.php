<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DayController extends ModuleController
{
    protected $moduleName = 'days';

    protected $titleColumnKey = 'date';

    protected $indexOptions = [
        'permalink' => false,
        'skipCreateModal' => true,
        'editInModal' => false,
        'create' => true,
    ];

//    protected $browserColumns = [
//        'days' => [
//            'title' => 'Title',
//            'field' => 'days',
//        ],
//    ];

//    protected function formData($request)
//    {
//        $dt = Carbon::now();
//        $dt2 = Carbon::now()->addWeek(4)->format('Y-m-d');
//        $weekends = collect();
//
//        $dt->diffInDaysFiltered(function(Carbon $date) use($weekends)  {
//                if($date->isWeekend()) {
//                    $weekends->push($date->format('Y-m-d'));
//                }
//        }, $dt2);
//
//        return [
//            'weekends' => $weekends,
//        ];
//    }
}
