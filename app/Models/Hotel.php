<?php

namespace App\Models;

use App\Http\Resources\HotelResource;
use App\Traits\HasAttachments;
use App\Traits\HasEvents;
use App\Traits\HasExcursionPoints;
use App\Traits\HasFavorites;
use App\Traits\HasViews;
use App\Traits\HasVisits;
use Illuminate\Database\Eloquent\Attributes\UseResource;
use Illuminate\Database\Eloquent\Model;

#[UseResource(HotelResource::class)]
class Hotel extends Model
{
    use HasAttachments, HasEvents, HasExcursionPoints, HasFavorites, HasViews, HasVisits;

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
