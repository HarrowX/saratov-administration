<?php

namespace App;

use App\Models\Event;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasEvents
{
    use HasRelationships;

    public function events(): MorphMany
    {
        return $this->morphMany(Event::class, 'eventable');
    }
}
