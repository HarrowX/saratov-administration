<?php

namespace App\Models;

use App\HasEvents;
use Illuminate\Database\Eloquent\Model;

class CustomLocation extends Model
{
    use HasEvents;

    protected $fillable = [
        'name', 'address', 'latitude', 'longitude', 'description',
    ];
}
