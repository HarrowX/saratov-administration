<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class GuidedTour extends Model
{
    protected $fillable = [
        'name',
        'short_description',
        'description',
        'experience',
        'phone',
        'email'
    ];

    public function attachments(): MorphMany {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
