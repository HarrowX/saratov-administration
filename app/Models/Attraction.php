<?php

namespace App\Models;

use App\HasAttachments;
use App\HasEvents;
use App\HasExcursionPoints;
use App\HasFavorites;
use App\HasViews;
use App\HasVisits;
use App\Http\Resources\AttractionResource;
use Illuminate\Database\Eloquent\Attributes\UseResource;
use Illuminate\Database\Eloquent\Model;

#[UseResource(AttractionResource::class)]
class Attraction extends Model
{
    use HasAttachments, HasViews, HasVisits, HasFavorites, HasEvents, HasExcursionPoints;

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
}
