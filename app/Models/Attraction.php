<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Attraction extends Model
{
    protected $fillable = [
        'name',
        'short_description',
        'description',
        'worktime',
        'phone',
        'address'
    ];

    public function attachments(): MorphMany {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
