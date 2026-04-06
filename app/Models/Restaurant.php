<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Restaurant extends Model
{
    protected $fillable = [
        'name',
        'description',
        'address',
        'worktime',
        'phone',
        'kitchen',
    ];

    protected $casts = [
        'worktime' => 'array',
    ];

    public function attachments(): MorphMany {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
