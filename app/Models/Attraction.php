<?php

namespace App\Models;

use App\HasSchedule;
use App\Http\Resources\AttractionResource;
use Illuminate\Database\Eloquent\Attributes\UseResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

#[UseResource(AttractionResource::class)]
class Attraction extends Model
{
    use HasSchedule;

    protected $fillable = [
        'name',
        'short_description',
        'description',
        'worktime',
        'phone',
        'address',
        'slug',
        'district',
        'latitude',
        'longitude',
        'email',
        //        'map_link',
        'website',
        'status',
        'ticket_price',
        'visit_duration',
        'is_accessible',
        'has_parking',
        'rating',
        'views_count',
        'created_by',
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
