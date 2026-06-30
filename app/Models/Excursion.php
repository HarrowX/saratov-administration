<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Excursion extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'type', 'duration',
        'distance', 'difficulty', 'group_size_min', 'group_size_max',
        'price_adult', 'price_child', 'price_group', 'is_free',
        'age_restriction', 'meeting_point', 'meeting_address', 'schedule_type',
        'operator_name', 'operator_phone', 'booking_enabled', 'rating', 'views_count', 'status',
    ];

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function points()
    {
        return $this->hasMany(ExcursionPoint::class)->orderBy('order');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
