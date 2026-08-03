<?php

namespace App\Models;

use App\Http\Resources\RestaurantResource;
use Illuminate\Database\Eloquent\Attributes\UseResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

#[UseResource(RestaurantResource::class)]
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

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function excursionPoints()
    {
        return $this->morphMany(ExcursionPoint::class, 'pointable');
    }

    public function events(): MorphMany
    {
        return $this->morphMany(Event::class, 'location');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoriteable');
    }

    public function visits(): MorphMany
    {
        return $this->morphMany(PlaceVisit::class, 'visitable');
    }

    public function views(): MorphMany
    {
        return $this->morphMany(HistoryView::class, 'viewable');
    }
}
