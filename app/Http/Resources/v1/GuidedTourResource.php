<?php

namespace App\Http\Resources\v1;

use App\Models\GuidedTour;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Sanctum\PersonalAccessToken;

class GuidedTourResource extends JsonResource
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
            'short_description' => $this->second_description,

            'class' => GuidedTour::class,

            'image' => $this->getPrimaryImageUrl(),
            'image_thumb' => $this->getPrimaryThumbImageUrl(),

            'is_favorite' => $isFavorite,

            'views_count' => $this->views_count,
            'favorites_count' => $this->favorites?->count() ?? 0,

            'experience' => $this->experience,
            'phone' => $this->phone,
            'email' => $this->email,
            'excursions' => ExcursionResource::collection($this->excursions),
            'attachments' => AttachmentResource::collection($this->attachments),
        ];
    }
}
