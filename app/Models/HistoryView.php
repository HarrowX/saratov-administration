<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class HistoryView extends Model
{
    protected $table = 'history_views';

    protected $fillable = [
        'user_id',
        'viewable_id',
        'viewable_type',
        'is_counted',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function viewable(): MorphTo
    {
        return $this->morphTo();
    }
}
