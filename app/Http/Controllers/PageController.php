<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Menu;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $currentWeekFirstDay = Carbon::now()->startOfWeek();
        $nextWeekFirstDay = Carbon::now()->addWeek()->startOfWeek();
        clock($nextWeekFirstDay);

        $alacarte = collect([
            'currentWeek' => Menu::query()->where('date',$currentWeekFirstDay->format('Y-m-d'))->with('alacarte')->first(),
            'nextWeek' => Menu::query()->where('date',$nextWeekFirstDay->format('Y-m-d'))->with('alacarte')->first()
        ]);

        $currentWeekPeriod = CarbonPeriod::create($currentWeekFirstDay->format('Y-m-d'), $currentWeekFirstDay->addDays(4)->format('Y-m-d'));
        $nextWeekPeriod = CarbonPeriod::create($nextWeekFirstDay->format('Y-m-d'), $nextWeekFirstDay->addDays(4)->format('Y-m-d'));

        $weeks = collect([
            'currentWeek'=>collect(),
            'nextWeek'=>collect(),
        ]);

        foreach ($currentWeekPeriod as $key => $value) {
            $model = Day::query()->with(['foods','drinks','alacarte'])->where('date',$value->format('Y-m-d'))->first();

            $weeks['currentWeek']->push([
                'day_name' => $value->locale('hu')->dayName,
                'date' => $value->format('Y-m-d'),
                'menu' => $model,
            ]);
        }

        foreach ($nextWeekPeriod as $key => $value) {
            $model = Day::query()->with(['foods','drinks','alacarte'])->where('date',$value->format('Y-m-d'))->first();

            $weeks['nextWeek']->push([
                'day_name' => $value->locale('hu')->dayName,
                'date' => $value->format('Y-m-d'),
                'menu' => $model,
            ]);
        }
        clock($weeks);

        $cart = session()->get('shopping-cart');

        return view('index',compact('weeks','cart','alacarte','currentWeekPeriod','nextWeekPeriod'));
    }

    public function dashboard()
    {
        $cart = session()->get('shopping-cart');

        return view('dashboard',compact('cart'));
    }

    public function aszf()
    {
        $cart = session()->get('shopping-cart');
        return view('aszf',compact('cart'));
    }
}
