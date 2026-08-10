<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ExcursionPoint extends Model
{
    protected $fillable = [
        'excursion_id', 'pointable_id', 'pointable_type', 'order', 'duration_minutes',
    ];

    public function excursion(): BelongsTo
    {
        return $this->belongsTo(Excursion::class);
    }

    public function excursionPointable(): MorphTo
    {
        return $this->morphTo();
    }
}
