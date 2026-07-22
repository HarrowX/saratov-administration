<?php

namespace App\Http\Resources;

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
        $attachment = $this->attachments()->orderBy('order')->first();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'shortDescription' => $this->short_description,
            'description' => $this->description,

            'image' => $attachment ? asset(Storage::url($attachment?->link)) : null,

            'type' => $this->type,
            'stars' => $this->stars,
            'worktime' => $this->worktime,
            'phone' => $this->phone,
            'address' => $this->addres,
            'district' => $this->district,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'email' => $this->email,
            'website' => $this->website,
            'maxPrice' => $this->max_price,
            'minPrice' => $this->min_pirce,

            'favoritesCount' => $this->favorites?->count(),

            'createdAt' => $this->created_at,
            'attachments' => AttachmentResource::collection($this->attachments),
        ];
    }
}
