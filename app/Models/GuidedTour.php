<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class GuidedTour extends Model
{
    protected $fillable = [
        'name',
        'description',
        'second_description',
        'experience',
        'phone',
        'email',
        'vk',
        'max',
    ];

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function excursions(): HasMany
    {
        return $this->hasMany(Excursion::class, 'guided_tour_id');
    }

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoriteable');
    }
}
