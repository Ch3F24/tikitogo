<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Model;

class Day extends Model
{
    use HasRevisions;

    protected $fillable = [
        'published',
        'date'
    ];

    public function products() {
        return $this->belongsToMany(Product::class,'day_product');
    }

    public function foods() {
        return $this->belongsToMany(Product::class,'day_product')->where('products.type','food');
    }

    public function drinks() {
        return $this->belongsToMany(Product::class,'day_product')->where('products.type','drink');
    }

    public function getTitleInBrowserAttribute()
    {
        return $this->date;
    }
}
