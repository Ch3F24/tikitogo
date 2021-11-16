@extends('twill::layouts.form')

@section('contentFields')
    @formField('input', [
        'name' => 'description',
        'label' => 'Description',
        'maxlength' => 100
    ])
    @formField('input', [
        'name' => 'net_price',
        'label' => 'Net Price',
        'required' => true,
        'type' => 'number',
        'note' => 'Hagyd üresen',
        'readonly' => true
    ])
    @formField('input', [
        'name' => 'gross_price',
        'label' => 'Gross Price',
        'required' => true,
        'type' => 'number',
    ])
    @formField('select', [
        'name' => 'tax',
        'label' => 'Tax',
        'placeholder' => 'Select tax',
        'options' => [
            [
            'value' => 27,
            'label' => '27%'
            ],
        ]
    ])
@stop
