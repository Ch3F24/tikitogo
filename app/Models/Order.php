<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Model;

class Order extends Model
{
    use HasSlug, HasRevisions;

    protected $fillable = [
        'published',
        'payment_id',
        'order_number',
        'total_gross_price',
        'status',
        'name',
        'shipping_postal_code',
        'shipping_address',
        'billing_name',
        'vat_number',
        'billing_postal_code',
        'billing_address',
        'billing_city',
        'phone',
        'user_id',
        'note',
        'pickup_date',
        'shipping_type'
    ];

    public $slugAttributes = [
        'payment_id',
    ];


    public function products()
    {
        return $this->hasMany(OrderProducts::class,'order_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
