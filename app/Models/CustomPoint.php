<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class CustomPoint extends Model
{
    protected $fillable = [
        'name', 'description', 'latitude', 'longitude', 'slug', 'order', 'duration_minutes',
    ];

    public function excursionPoints(): MorphMany
    {
        return $this->morphMany(ExcursionPoint::class, 'pointable');
    }
}
