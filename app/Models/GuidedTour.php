<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class GuidedTour extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'second_description',
        'duration',
        'distance',
        'group_size_min',
        'group_size_max',
        'price_adult',
        'price_child',
        'price_group',
        'is_free',
        'ade_restriction',
        'meeting_point',
        'meeting_address',
        'schedule_type',
        'guided_tour_id',
        'booking_enable',
        'rating',
        'views_count',
        'status',
        'created_at',
        'experience',
        'phone',
        'email',
        'vk',
        'max',
    ];

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function excursions(): HasMany
    {
        return $this->hasMany(Excursion::class, 'guided_tour_id');
    }
}
