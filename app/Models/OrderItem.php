<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'variation_name',
        'product_name',
        'custom_options',
        'price',
        'quantity'
    ];

    protected $casts = [
        'custom_options' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}