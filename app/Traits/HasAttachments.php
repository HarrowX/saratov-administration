<?php

namespace App\Traits;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

trait HasAttachments
{
    use HasRelationships;

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    protected function getDefaultImagePath(): ?string
    {
        return null;
    }


    public function getPrimaryImageUrl(): ?string
    {
        $attachment = $this->attachments()->first();

        return $attachment ? $attachment->getUrl() : $this->getDefaultImagePath();
    }


    public function getAltPrimaryImage(): ?string
    {
        $attachment = $this->attachments()->first();

        if ($attachment == null || $attachment->alt_name == '') {
            return 'Изображение ' . $this->name;
        }

        return $attachment->alt_name;
    }


    public function getPrimaryThumbImageUrl(): ?string
    {
        $attachment = $this->attachments()->first();

        return $attachment?->getThumbUrl() ?? $this->getPrimaryImageUrl();
    }
}
