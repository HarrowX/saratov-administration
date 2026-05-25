<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
        'operator_name',
        'operator_phone',
        'booking_enable',
        'rating',
        'views_count',
        'status',
        'created_at',
        'experience',
        'phone',
        'email'
    ];

    public function attachments(): MorphMany {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
