<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $first_day = Carbon::now()->startOfWeek();
        $period = CarbonPeriod::create($first_day->format('Y-m-d'), $first_day->addDays(4)->format('Y-m-d'));
        $days = collect();

        foreach ($period as $key => $value) {
            clock($value);
            $model = Day::query()->with(['foods','drinks'])->where('date',$value->format('Y-m-d'))->first();

            $days->push([
                'day_name' => $value->locale('hu')->dayName,
                'date' => $value->format('Y-m-d'),
                'menu' => $model,
            ]);
        }

        $cart = session()->get('shopping-cart');

        return view('index',compact('days','cart'));
    }

    public function dashboard()
    {
        $cart = session()->get('shopping-cart');

        return view('dashboard',compact('cart'));
    }
}
