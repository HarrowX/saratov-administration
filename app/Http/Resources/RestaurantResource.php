<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,

            'description' => $this->description,
            'address' => $this->address,
            'district' => $this->district,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'worktime' => $this->worktime,
            'phone' => $this->phone,
            'kitchen' => $this->kitchen,
            'email' => $this->email,
            "website" => $this->website,

            "priceCategory" => $this->price_category,
            "capacity" => $this->capipacity,
            "rating" => $this->rating,

            'favoritesCount' => $this->favorites->count(),

            "createdAt" => $this->created_at,
            'attachments' => AttachmentResource::collection($this->attachments),
        ];
    }
}
