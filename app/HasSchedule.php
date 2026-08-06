<?php

namespace App;

use App\Models\ScheduleRecord;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasSchedule
{


    public function scheduleRecords(): MorphMany
    {
        return $this->morphMany(ScheduleRecord::class, 'schedulable');
    }
}
