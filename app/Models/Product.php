<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'stock',
        'is_featured',
        'images',
        'category',
        'subtitle',
        'details',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function getIsSoldOutAttribute(): bool
    {
        return $this->stock <= 0;
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(\App\Models\OrderItem::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Product $product) {
            if ($product->orderItems()->exists()) {
                throw new \Exception('Produk ini tidak bisa dihapus karena sudah ada di dalam pesanan.');
            }
        });
    }
}
