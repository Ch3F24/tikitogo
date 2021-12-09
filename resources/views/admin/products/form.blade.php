@extends('twill::layouts.form')

@section('contentFields')
    @formField('input', [
        'name' => 'description',
        'label' => 'Leírás',
        'maxlength' => 100
    ])

    @formField('select', [
    'name' => 'type',
    'label' => 'Termék típusa',
    'placeholder' => 'Select food type',
    'options' => [
        [
            'value' => 'food',
            'label' => 'Étel'
        ],
        [
            'value' => 'dessert',
            'label' => 'Desszert'
        ],
        [
            'value' => 'drink',
            'label' => 'Ital'
        ]
    ]
    ])

    @formField('input', [
        'name' => 'net_price',
        'label' => 'Nettó ár',
        'required' => true,
        'type' => 'number',
        'note' => 'Hagyd üresen',
        'readonly' => true,
        'disabled' => true
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

    @formField('multi_select', [
        'name' => 'allergens',
        'label' => 'Allergének',
        'unpack' => false,
        'options' => [
            [
            'value' => 1,
            'label' => 'Glutén'
            ],
            [
            'value' => 2,
            'label' => 'Tej'
            ],
            [
            'value' => 3,
            'label' => 'tojás'
            ],
            [
            'value' => 4,
            'label' => 'Hal'
            ],
            [
            'value' => 5,
            'label' => 'Szójabab'
            ],
            [
            'value' => 6,
            'label' => 'Diófélék'
            ],
            [
            'value' => 7,
            'label' => 'Mustár'
            ],
            [
            'value' => 8,
            'label' => 'Zeller'
            ],
            [
            'value' => 9,
            'label' => 'Rákfélék'
            ],
            [
            'value' => 10,
            'label' => 'Puhatestűek'
            ],
            [
            'value' => 11,
            'label' => 'Szezámmag'
            ],
            [
            'value' => 12,
            'label' => 'Földimogyoró'
            ],
            [
            'value' => 13,
            'label' => 'Csillagfürt'
            ],
            [
            'value' => 14,
            'label' => 'Édesgyökér'
            ],
            [
            'value' => 15,
            'label' => 'Kén-dioxid'
            ],
            [
            'value' => 16,
            'label' => 'Mesterséges édesítőszer'
            ]
        ]
    ])

    @formField('browser', [
        'moduleName' => 'options',
        'name' => 'options',
        'label' => 'Extrák',
        'max' => '-1'
    ])
@stop
