<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NavMegaGroup extends Model
{
    protected $fillable = ['nav_item_id', 'label', 'url', 'sort_order'];

    public function navItem(): BelongsTo
    {
        return $this->belongsTo(NavItem::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(NavMegaItem::class)->orderBy('sort_order');
    }
}
