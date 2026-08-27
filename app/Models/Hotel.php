<?php

namespace App\Models;

use App\HasSchedules;
use App\Http\Resources\v1\HotelResource;
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
    use HasAttachments, HasEvents, HasExcursionPoints, HasFavorites, HasSchedules, HasViews, HasVisits;

    protected ?string $defaultImagePath = '/images/image-coming-soon-hotel.webp';

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

    protected function getDefaultImagePath(): ?string
    {
        return asset('images/coming-soon-hotel.webp');
    }
}
