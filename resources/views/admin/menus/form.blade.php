@extends('twill::layouts.form')

@section('contentFields')
    @formField('date_picker', [
        'name' => 'date',
        'label' => 'Hét első napja',
        'withTime' => false,
        'required' => true,
{{--        'minDate' => 'today',--}}
    ])
    @formField('browser', [
        'moduleName' => 'days',
        'name' => 'days',
        'label' => 'Days',
        'max' => '5'
    ])
    @formField('browser', [
    'moduleName' => 'products',
    'name' => 'alacarte',
    'label' => 'alacarte',
    'max' => '-1'
    ])
@stop
