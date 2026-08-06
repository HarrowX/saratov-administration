<?php

namespace App\Models;

use App\HasExcursionPoints;
use Illuminate\Database\Eloquent\Model;

class CustomPoint extends Model
{
    use HasExcursionPoints;

    protected $fillable = [
        'name', 'description', 'latitude', 'longitude', 'slug', 'order', 'duration_minutes',
    ];
}
