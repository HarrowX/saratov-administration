<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'slug' => $this->slug,
            'description' => $this->description,
            'categories' => CategoryResource::collection($this->categories),

            'image' => $this->getPrimaryImageUrl(),
            'image_thumb' => $this->getPrimaryThumbImageUrl(),

            'is_favorite' => $isFavorite,

            'address' => $this->address,
            'age_restriction' => $this->age_restriction,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,

            'views_count' => $this->views_count,
            'favorites_count' => $this->favorites?->count() ?? 0,

            'attachments' => AttachmentResource::collection($this->attachments),
        ];
    }
}
