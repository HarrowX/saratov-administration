<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class GuidedTourResource extends JsonResource
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
            'shortDescription' => $this->second_description,

            'image' => $attachment ? asset(Storage::url($attachment?->link)) : null,

            'experience' => $this->experience,
            'phone' => $this->phone,
            'email' => $this->email,
            'excursions' => ExcursionResource::collection($this->excursions),
            'attachments' => AttachmentResource::collection($this->attachments),
        ];
    }
}
