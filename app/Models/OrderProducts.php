<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'option_id',
        'menu_date',
        'net_price',
        'gross_price'
    ];

    public function order()
    {
        return $this->hasOne(Order::class,'order_id');
    }

    public function products() {
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function options() {
        return $this->hasOne(Option::class,'id','option_id');
    }

    public function productOptions()
    {
        return $this->belongsToMany(Option::class,'order_product_options','order_product_id','option_id')->withPivot(['gross_price','net_price']);
    }

}
