@extends('twill::layouts.form')

@section('contentFields')
    @formField('date_picker', [
        'name' => 'date',
        'label' => 'Menü napja',
        'withTime' => false,
        'required' => true,
        'minDate' => 'today',
        'maxDate' =>  \Carbon\Carbon::now()->addWeek(4)->format("Y-m-d"),

    ])
    @formField('browser', [
        'moduleName' => 'products',
        'name' => 'products',
        'label' => 'Products',
        'max' => '-1'
    ])

    @formField('browser', [
    'moduleName' => 'products',
    'name' => 'alacarte',
    'label' => 'alacarte',
    'max' => '-1'
    ])
@stop
