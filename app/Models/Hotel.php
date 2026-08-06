<?php

namespace App\Models;

use App\HasAttachments;
use App\HasEvents;
use App\HasExcursionPoints;
use App\HasFavorites;
use App\HasViews;
use App\HasVisits;
use App\Http\Resources\HotelResource;
use Illuminate\Database\Eloquent\Attributes\UseResource;
use Illuminate\Database\Eloquent\Model;

#[UseResource(HotelResource::class)]
class Hotel extends Model
{
    use HasAttachments, HasExcursionPoints, HasEvents, HasFavorites, HasVisits, HasViews;

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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
