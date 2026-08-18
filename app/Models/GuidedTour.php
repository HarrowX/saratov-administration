<?php

namespace App\Models;

use App\Traits\HasAttachments;
use App\Traits\HasFavorites;
use App\Traits\HasViews;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GuidedTour extends Model
{
    use HasAttachments, HasFavorites, HasViews;

    protected $fillable = [
        'name',
        'description',
        'second_description',
        'experience',
        'phone',
        'email',
        'vk',
        'max',
        'views_count',
    ];

    public function excursions(): HasMany
    {
        return $this->hasMany(Excursion::class, 'guided_tour_id');
    }
}
