<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface HasScheduleContract
{
    function schedules(): MorphMany;
}
