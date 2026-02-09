<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'is_featured',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];
}
