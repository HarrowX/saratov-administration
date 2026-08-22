<?php

namespace App\Http\Resources\v2\alpine;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExcursionV2AlpineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isFavorite = $this->favorites->where('user_id', $request->user()->id)->isNotEmpty() || false;

        return [
            'id' => $this->id,
            'name' => $this->name,

            'description' => $this->description,

            'primary_image_url' => $this->getPrimaryImageUrl(),
            'thumb_primary_image_url' => $this->getPrimaryThumbImageUrl(),

            'is_favorite' => $isFavorite,

            'price_adult' => $this->price_adult,
            'price_child' => $this->price_child,
            'price_group' => $this->price_group,

            'views_count' => $this->views_count,
            'favorites_count' => $this->favorites?->count() ?? 0,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}
