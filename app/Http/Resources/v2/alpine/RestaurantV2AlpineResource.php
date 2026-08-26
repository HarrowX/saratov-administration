<?php

namespace App\Http\Resources\v2\alpine;

use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Sanctum\PersonalAccessToken;

class RestaurantV2AlpineResource extends JsonResource
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

            'primary_image_url' => $this->getPrimaryImageUrl(),
            'thumb_primary_image_url' => $this->getPrimaryThumbImageUrl(),

            'is_favorite' => $isFavorite,

            'views_count' => $this->views_count,
            'favorites_count' => $this->favorites?->count() ?? 0,

            'created_at' => $this->created_at,
        ];
    }
}
