<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleRecord extends Model
{
    public function schedulable()
    {
        return $this->morphTo();
    }
}
