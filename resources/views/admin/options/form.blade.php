@extends('twill::layouts.form')

@section('contentFields')
    @formField('input', [
        'name' => 'description',
        'label' => 'Leírás',
        'maxlength' => 100
    ])
    @formField('input', [
        'name' => 'net_price',
        'label' => 'Nettó ár',
        'required' => true,
        'type' => 'number',
        'note' => 'Hagyd üresen',
        'readonly' => true
    ])
    @formField('input', [
        'name' => 'gross_price',
        'label' => 'Bruttó ár',
        'required' => true,
        'type' => 'number',
    ])
    @formField('select', [
        'name' => 'tax',
        'label' => 'Áfa',
        'placeholder' => 'Select tax',
        'options' => [
            [
            'value' => 27,
            'label' => '27%'
            ],
        ]
    ])
@stop
