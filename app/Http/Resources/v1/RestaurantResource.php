<?php

namespace App\Http\Resources\v1;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Sanctum\PersonalAccessToken;

class RestaurantResource extends JsonResource
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

            'class' => Restaurant::class,

            'image' => $this->getPrimaryImageUrl(),
            'image_thumb' => $this->getPrimaryThumbImageUrl(),

            'is_favorite' => $isFavorite,

            'description' => $this->description,
            'address' => $this->address,
            'district' => $this->district,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'worktime' => $this->worktime,
            'phone' => $this->phone,
            'kitchen' => $this->kitchen,
            'email' => $this->email,
            'website' => $this->website,

            'price_category' => $this->price_category,
            'capacity' => $this->capacity,
            'rating' => $this->rating,

            'views_count' => $this->views_count,
            'favorites_count' => $this->favorites?->count() ?? 0,

            'created_at' => $this->created_at,
            'attachments' => AttachmentResource::collection($this->attachments),
        ];
    }
}
