<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $attachment = $this->attachments()->first();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'categories' => CategoryResource::collection($this->categories),

            'image' => $attachment ? asset(Storage::url($attachment?->link)) : null,

            'address' => $this->address,
            'age_restriction' => $this->age_restriction,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'attachments' => AttachmentResource::collection($this->attachments),
        ];
    }
}
