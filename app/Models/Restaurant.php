<?php

namespace App\Models;

use App\HasAttachments;
use App\HasEvents;
use App\HasExcursionPoints;
use App\HasFavorites;
use App\HasViews;
use App\HasVisits;
use App\Http\Resources\RestaurantResource;
use Illuminate\Database\Eloquent\Attributes\UseResource;
use Illuminate\Database\Eloquent\Model;

#[UseResource(RestaurantResource::class)]
class Restaurant extends Model
{
    use HasAttachments, HasEvents, HasExcursionPoints, HasFavorites, HasViews, HasVisits;

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
}
