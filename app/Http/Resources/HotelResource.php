<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" =>  $this->name,
            "short_description" =>  $this->short_description,
            "description" => $this->description,
            "type" => $this->type,
            "stars" => $this->stars,
            "worktime" => $this->worktime,
            "phone" => $this->phone,
            "address" => $this->addres,
            "district" => $this->district,
            "longitude" => $this->longitude,
            "latitude" => $this->latitude,
            "email" => $this->email,
            "website" => $this->website,
            "max_price" => $this->max_price,
            "min_price" => $this->min_pirce,
            "created_at" => $this->created_at,
            "attachments" => AttachmentResource::collection($this->attachments),
        ];
    }
}
