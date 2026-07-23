<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class CustomLocation extends Model
{
    protected $fillable = [
        'name', 'address', 'latitude', 'longitude', 'description'
    ];

    public function events(): MorphMany
    {
        return $this->morphMany(Event::class, 'location');
    }
}
