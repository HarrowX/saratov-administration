<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Restaurant extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'address',
        'district',
        'latitude',
        'longitude',
        'worktime',
        'phone',
        'kitchen',
        'email',
        'map_link',
        'website',
        'price_category',
        'capacity',
        'rating',
        'reviews_count',
        'views_count',
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

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoriteable');
    }
}
