<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttractionResource extends JsonResource
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

            "name" =>  $this->name,
            'slug' => $this->slug,
            "shortDescription" =>  $this->short_description,
            "description" => $this->description,

            "worktime" => $this->worktime,
            "phone" => $this->phone,
            "address" => $this->addres,
            "district" => $this->district,
            "longitude" => $this->longitude,
            "latitude" => $this->latitude,

            'email' => $this->email,
            "website" => $this->website,

            "status" => $this->status,
            'ticketPrice' => $this->ticket_price,
            'visitDuration' => $this->visit_duration,

            'isAccessible' => (bool) $this->is_accessible,
            'hasParking'   => (bool) $this->has_parking,

            'displayLocation' => $this->display_location,
            'viewsCount' => $this->views_count,
            'favoritesCount' => $this->favorites_count,

            "createdAt" => $this->created_at,
            'attachments' => AttachmentResource::collection($this->attachments),
        ];
    }
}

