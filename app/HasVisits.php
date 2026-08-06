<?php

namespace App;

use App\Models\PlaceVisit;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasVisits
{
    use HasRelationships;

    public function visits(): MorphMany
    {
        return $this->morphMany(PlaceVisit::class, 'visitable');
    }
}
