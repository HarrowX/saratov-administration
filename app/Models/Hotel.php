<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Hotel extends Model
{
    protected $fillable = [
        'name',
        'type',
        'description',
        'second_description',
        'map_link',
        'worktime',
        'phone',
        'address',
    ];

    protected $casts = [
        'worktime' => 'array',
    ];

    public function attachments(): MorphMany {
        return $this->morphMany(Attachment::class, 'attachable');
    }
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
