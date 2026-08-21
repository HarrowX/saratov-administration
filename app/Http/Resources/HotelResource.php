<?php

namespace App\Http\Resources;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class HotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $attachment = $this->attachments()->first();
        $isFavorite = $this->favorites->where('user_id', $request->user()->id)->isNotEmpty() || false;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'description' => $this->description,

            'class' => Hotel::class,

            'image' => $this->getPrimaryImageUrl(),
            'image_thumb' => $this->getPrimaryThumbImageUrl(),

            'is_favorite' => $isFavorite,

            'type' => $this->type,
            'stars' => $this->stars,
            'worktime' => $this->worktime,
            'phone' => $this->phone,
            'address' => $this->address,
            'district' => $this->district,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'email' => $this->email,
            'website' => $this->website,
            'max_price' => $this->max_price,
            'min_price' => $this->min_price,

            'favorites_count' => $this->favorites?->count() ?? 0,

            'created_at' => $this->created_at,
            'attachments' => AttachmentResource::collection($this->attachments),
        ];
    }
}
