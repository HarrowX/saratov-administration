<?php

namespace App\Http\Resources\v1;

use App\Models\Excursion;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Sanctum\PersonalAccessToken;

class ExcursionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isFavorite = null;

        if ($request->bearerToken()) {
            $accessToken = PersonalAccessToken::findToken($request->bearerToken());

            if ($accessToken && $accessToken->tokenable_type === User::class) {

                if ($accessToken->expires_at > now()) {
                    throw new HttpResponseException(response()->json(['message' => 'Unauthenticated.'], 401));
                }

                $userId = $accessToken->tokenable_id;

                $isFavorite = $this->favorites()
                    ->where('user_id', $userId)
                    ->exists();
            }
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,

            'class' => Excursion::class,

            'image' => $this->getPrimaryImageUrl(),
            'image_thumb' => $this->getPrimaryThumbImageUrl(),

            'is_favorite' => $isFavorite,

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
            'favorites_count' => $this->favorites?->count() ?? 0,

            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'excursion_points' => ExcursionPointResource::collection($this->points),

            'attachments' => AttachmentResource::collection($this->attachments),
        ];
    }
}
