<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface HasScheduleContract
{
    public function schedules(): MorphMany;
}
