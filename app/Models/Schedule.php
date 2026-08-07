<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Schedule extends Model
{
    public function schedulable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scheduleRecords(): HasMany
    {
        return $this->hasMany(ScheduleRecord::class, 'schedule_id');
    }
}
