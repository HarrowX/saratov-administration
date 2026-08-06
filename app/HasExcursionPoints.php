<?php

namespace App;

use App\Models\ExcursionPoint;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasExcursionPoints
{
    use HasRelationships;

    public function excursionPoints(): MorphMany
    {
        return $this->morphMany(ExcursionPoint::class, 'pointable');
    }
}
