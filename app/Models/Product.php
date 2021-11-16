<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;

class Product extends Model implements Sortable
{
    use HasSlug, HasMedias, HasRevisions, HasPosition;

    protected $casts = [
        'allergens' => 'array'
    ];

    protected $fillable = [
        'published',
        'title',
        'description',
        'position',
        'allergens',
        'quantity',
        'net_price',
        'gross_price',
        'tax',
        'type',

    ];

    public $slugAttributes = [
        'title',
    ];

    public $mediasParams = [
        'cover' => [
            'default' => [
                [
                    'name' => 'default',
                    'ratio' => 16 / 9,
                ],
            ],
            'mobile' => [
                [
                    'name' => 'mobile',
                    'ratio' => 1,
                ],
            ],
            'flexible' => [
                [
                    'name' => 'free',
                    'ratio' => 0,
                ],
                [
                    'name' => 'landscape',
                    'ratio' => 16 / 9,
                ],
                [
                    'name' => 'portrait',
                    'ratio' => 3 / 5,
                ],
            ],
        ],
    ];

    public function getAllergensAttribute($value)
    {
        return collect(json_decode($value))->map(function($item) {
            return ['id' => $item];
        })->sortBy('id')->all();
    }

    public function setAllergensAttribute($value)
    {
        $this->attributes['allergens'] = collect($value)->filter()->values();
    }

    public function options() {
        return $this->belongsToMany(Option::class,'product_option');
    }
}
