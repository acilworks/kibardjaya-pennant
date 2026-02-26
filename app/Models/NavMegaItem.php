<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NavMegaItem extends Model
{
    protected $fillable = ['nav_mega_group_id', 'label', 'url', 'sort_order'];

    public function group(): BelongsTo
    {
        return $this->belongsTo(NavMegaGroup::class, 'nav_mega_group_id');
    }
}
