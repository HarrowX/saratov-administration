<?php

namespace App\Models;

use App\HasSchedules;
use App\Http\Resources\v1\RestaurantResource;
use App\Traits\HasAttachments;
use App\Traits\HasEvents;
use App\Traits\HasExcursionPoints;
use App\Traits\HasFavorites;
use App\Traits\HasViews;
use App\Traits\HasVisits;
use Illuminate\Database\Eloquent\Attributes\UseResource;
use Illuminate\Database\Eloquent\Model;

#[UseResource(RestaurantResource::class)]
class Restaurant extends Model
{
    use HasAttachments, HasEvents, HasExcursionPoints, HasFavorites, HasSchedules, HasViews, HasVisits;

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
        //        'map_link',
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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function getDefaultImagePath(): ?string
    {
        return asset('images/coming-soon-restaurant.webp');
    }
}
