<?php

namespace App\Http\Resources\v2\alpine;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceVisitV2AlpineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'place' => $this->visitable->toResource(),
            'status' => $this->status,
            'placeable_type' => $this->visitable_type,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
