<?php

namespace App\Http\Resources;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class RestaurantResource extends JsonResource
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

            'class' => Restaurant::class,

            'image' => $attachment ? asset(Storage::url($attachment?->link)) : null,
            'isFavorite' => $isFavorite,

            'description' => $this->description,
            'address' => $this->address,
            'district' => $this->district,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'worktime' => $this->worktime,
            'phone' => $this->phone,
            'kitchen' => $this->kitchen,
            'email' => $this->email,
            'website' => $this->website,

            'priceCategory' => $this->price_category,
            'capacity' => $this->capacity,
            'rating' => $this->rating,

            'favoritesCount' => $this->favorites?->count() ?? 0,

            'createdAt' => $this->created_at,
            'attachments' => AttachmentResource::collection($this->attachments),
        ];
    }
}
