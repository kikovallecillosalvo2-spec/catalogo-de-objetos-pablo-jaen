<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'pokemon_type',
        'rarity',
        'set_name',
        'card_number',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];
}
