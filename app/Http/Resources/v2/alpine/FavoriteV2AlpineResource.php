<?php

namespace App\Http\Resources\v2\alpine;

use App\Models\Attraction;
use App\Models\Excursion;
use App\Models\GuidedTour;
use App\Models\Hotel;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteV2AlpineResource extends JsonResource
{
    private static array $mapper = [
        Attraction::class => AttractionV2AlpineResource::class,
        Hotel::class => HotelV2AlpineResource::class,
        Restaurant::class => RestaurantV2AlpineResource::class,
        Excursion::class => ExcursionV2AlpineResource::class,
        GuidedTour::class => GuidedTourV2AlpineResource::class,
    ];

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (! array_key_exists($this->favoriteable_type, self::$mapper)) {
            throw new \InvalidArgumentException('Unknown favoriteable type in favorite resource: '.$this->favoriteable_type);
        }

        $resource = self::$mapper[$this->favoriteable_type];

        return [
            'item' => $resource::make($this->favoriteable)->toArray($request),
            'class' => $this->favoriteable_type,
        ];
    }
}
