<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AttachmentResource extends JsonResource
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
            'attachableType' => $this->attachable_type,
            'attachableId' => $this->attachable_id,
            'order' => $this->order,
            'link' =>  asset(Storage::url($this->link)),
            'createdAt' => $this->created_at,
        ];
    }
}
