<?php

namespace App\Http\Resources\v1;

use App\Models\GuidedTour;
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
        $attachment = $this->attachments()->first();
        $isFavorite = $this->favorites->where('user_id', $request->user()->id)->isNotEmpty() || false;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'short_description' => $this->second_description,

            'class' => GuidedTour::class,

            'image' => $attachment ? asset(Storage::url($attachment?->link)) : null,
            'is_favorite' => $isFavorite,

            'favorites_count' => $this->favorites?->count() ?? 0,

            'experience' => $this->experience,
            'phone' => $this->phone,
            'email' => $this->email,
            'excursions' => ExcursionResource::collection($this->excursions),
            'attachments' => AttachmentResource::collection($this->attachments),
        ];
    }
}
