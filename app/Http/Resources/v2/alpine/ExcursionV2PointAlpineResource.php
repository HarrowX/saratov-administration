<?php

namespace App\Http\Resources\v2\alpine;

use App\Models\Attraction;
use App\Models\CustomPoint;
use App\Models\Hotel;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExcursionV2PointAlpineResource extends JsonResource
{
    private static array $mapper = [
        Attraction::class => AttractionV2AlpineResource::class,
        Hotel::class => HotelV2AlpineResource::class,
        Restaurant::class => RestaurantV2AlpineResource::class,
        CustomPoint::class => CustomPointV2AlpineResource::class,
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
