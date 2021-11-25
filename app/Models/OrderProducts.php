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
        'menu_date'
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

}
