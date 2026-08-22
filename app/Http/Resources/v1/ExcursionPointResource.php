<?php

namespace App\Http\Resources\v1;

use App\Models\Attraction;
use App\Models\CustomPoint;
use App\Models\Hotel;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExcursionPointResource extends JsonResource
{
    private static array $mapper = [
        Attraction::class => AttractionResource::class,
        Hotel::class => HotelResource::class,
        Restaurant::class => RestaurantResource::class,
        CustomPoint::class => CustomPointResource::class,
    ];

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (! array_key_exists($this->excursion_pointable_type, self::$mapper)) {
            throw new \InvalidArgumentException('Unknown favoriteable type in favorite resource: '.$this->excursion_pointable_type);
        }

        $resource = self::$mapper[$this->excursion_pointable_type];

        return $resource::make($this->excursionPointable)->toArray($request);
    }
}
