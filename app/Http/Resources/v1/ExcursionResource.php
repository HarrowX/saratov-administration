<?php

namespace App\Http\Resources\v1;

use App\Models\Excursion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ExcursionResource extends JsonResource
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
            'description' => $this->description,

            'class' => Excursion::class,

            'image' => $attachment ? asset(Storage::url($attachment?->link)) : null,
            'is_favorite' => $isFavorite,

            'favorites_count' => $this->favorites?->count() ?? 0,

            'guide_id' => $this->guided_tour_id,
            'type' => $this->type,
            'duration' => $this->getDuration(),
            'distance' => $this->distance,
            'difficulty' => $this->difficulty,
            'group_size_min' => $this->group_size_min,
            'group_size_max' => $this->group_size_max,
            'price_adult' => $this->price_adult,
            'price_child' => $this->price_child,
            'price_group' => $this->price_group,
            'is_free' => $this->is_free,
            'age_restriction' => $this->age_restriction,
            'meeting_point' => $this->meeting_point,
            'meeting_address' => $this->meeting_address,
            'schedule_type' => $this->schedule_type,
            'booking_enabled' => $this->booking_enabled,
            'rating' => $this->rating,
            'views_count' => $this->views_count,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'excursion_points' => ExcursionPointResource::collection($this->points),

            'attachments' => AttachmentResource::collection($this->attachments),
        ];
    }
}
