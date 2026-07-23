<?php

namespace App\Http\Resources;

use App\Models\Attraction;
use App\Models\Excursion;
use App\Models\GuidedTour;
use App\Models\Hotel;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
{
    private static array $mapper = [
        Attraction::class => AttractionResource::class,
        Hotel::class => HotelResource::class,
        Restaurant::class => RestaurantResource::class,
        Excursion::class => ExcursionResource::class,
        GuidedTour::class => GuidedTourResource::class,
    ];

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $resource =  self::$mapper[$this->favoriteable_type];
        return $resource::make($this->favoriteable)->toArray($request);
    }
}
