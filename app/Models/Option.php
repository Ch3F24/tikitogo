<?php

namespace App\Models;


use A17\Twill\Models\Model;

class Option extends Model
{
    protected $fillable = [
        'published',
        'title',
        'description',
        'net_price',
        'gross_price',
        'tax'
    ];

    public function orderProducts()
    {
        return $this->belongsToMany(OrderProducts::class,'order_id');
    }

}
