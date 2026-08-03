<?php

namespace App\Models;

use App\Http\Resources\HotelResource;
use Illuminate\Database\Eloquent\Attributes\UseResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

#[UseResource(HotelResource::class)]
class Hotel extends Model
{
    protected $fillable = [
        'name',
        'type',
        'description',
        'second_description',
//        'map_link',
        'worktime',
        'phone',
        'address',
    ];

    protected $casts = [
        'worktime' => 'array',
    ];

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function excursionPoints(): MorphMany
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
