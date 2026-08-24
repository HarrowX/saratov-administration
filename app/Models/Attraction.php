<?php

namespace App\Models;

use App\Http\Resources\v1\AttractionResource;
use App\Traits\HasAttachments;
use App\Traits\HasEvents;
use App\Traits\HasExcursionPoints;
use App\Traits\HasFavorites;
use App\Traits\HasViews;
use App\Traits\HasVisits;
use Illuminate\Database\Eloquent\Attributes\UseResource;
use Illuminate\Database\Eloquent\Model;

#[UseResource(AttractionResource::class)]
class Attraction extends Model
{
    use HasAttachments, HasEvents, HasExcursionPoints, HasFavorites, HasViews, HasVisits;

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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function getDefaultImagePath(): ?string
    {
        return asset('images/coming-soon-attraction.webp');
    }
}
