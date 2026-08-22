<?php

namespace App\Traits;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasAttachments
{
    use HasRelationships;

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function firstAttachment(): ?Attachment
    {
        return $this->attachments()->first();
    }
}
