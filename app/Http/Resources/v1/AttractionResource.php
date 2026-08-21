<?php

namespace App\Http\Resources\v1;

use App\Models\Attraction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AttractionResource extends JsonResource
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
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'description' => $this->description,

            'class' => Attraction::class,

            'image' => $this->getPrimaryImageUrl(),
            'image_thumb' => $this->getPrimaryThumbImageUrl(),

            'is_favorite' => $isFavorite,

            'worktime' => $this->worktime,
            'phone' => $this->phone,
            'address' => $this->address,
            'district' => $this->district,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,

            'email' => $this->email,
            'website' => $this->website,

            'status' => $this->status,
            'ticket_price' => $this->ticket_price,
            'visit_duration' => $this->visit_duration,

            'is_accessible' => (bool) $this->is_accessible,
            'has_parking' => (bool) $this->has_parking,

            'display_location' => $this->display_location,

            'views_count' => $this->views_count,
            'favorites_count' => $this->favorites?->count() ?? 0,

            'created_at' => $this->created_at,
            'attachments' => AttachmentResource::collection($this->attachments),
        ];
    }
}
