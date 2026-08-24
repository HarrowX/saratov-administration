<?php

namespace App\Http\Resources\v2\alpine;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelV2AlpineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isFavorite = null;
        if (\Auth::check()) {
            $isFavorite = $this?->favorites?->where('user_id', $request?->user()?->id)->isNotEmpty();
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'short_description' => $this->short_description,

            'primary_image_url' => $this->getPrimaryImageUrl(),
            'thumb_primary_image_url' => $this->getPrimaryThumbImageUrl(),

            'is_favorite' => $isFavorite,

            'views_count' => $this->views_count,
            'favorites_count' => $this->favorites?->count() ?? 0,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
