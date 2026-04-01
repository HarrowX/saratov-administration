<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Hotel extends Model
{
    protected $fillable = [
        'name',
        'category',
        'description',
        'secondDescription',
        'worktime',
        'phone',
        'address',
    ];

    public function attachments(): MorphMany {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
