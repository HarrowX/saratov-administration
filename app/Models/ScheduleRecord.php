<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduleRecord extends Model
{
    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
}
