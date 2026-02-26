<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NavItem extends Model
{
    protected $fillable = [
        'label',
        'url',
        'position',
        'has_mega_menu',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'has_mega_menu' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function megaGroups(): HasMany
    {
        return $this->hasMany(NavMegaGroup::class)->orderBy('sort_order');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }

    public function scopeLeft(Builder $query): Builder
    {
        return $query->where('position', 'left');
    }

    public function scopeRight(Builder $query): Builder
    {
        return $query->where('position', 'right');
    }
}

