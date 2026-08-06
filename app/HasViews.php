<?php

namespace App;

use App\Models\HistoryView;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasViews
{
    use HasRelationships;
    public function views(): MorphMany
    {
        return $this->morphMany(HistoryView::class, 'viewable');
    }
}
