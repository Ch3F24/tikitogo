<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Model;

class Menu extends Model
{
    use HasSlug, HasRevisions;

    protected $fillable = [
        'published',
        'date'
    ];

    public $slugAttributes = [
        'date',
    ];

    public function days() {
        return $this->belongsToMany(Day::class,'menu_day');
    }

    public function alacarte() {
        return $this->belongsToMany(Product::class,'menu_alacarte');
    }

}
