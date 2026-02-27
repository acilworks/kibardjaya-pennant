<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'is_studio_pick',
        'images',
        'category',
        'category_id',
        'sub_category_id',
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

    public function categoryRelation(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function colorVariants(): HasMany
    {
        return $this->hasMany(ProductColorVariant::class)->orderBy('sort_order');
    }

    public function getHasColorVariantsAttribute(): bool
    {
        return $this->colorVariants->isNotEmpty();
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
