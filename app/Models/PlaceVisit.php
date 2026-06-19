<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PlaceVisit extends Model
{
    public $table = 'place_visits';

    public $fillable = [
        'user_id',
        'visitable_id',
        'visitable_type',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function visitable(): MorphTo
    {
        return $this->morphTo();
    }
}
