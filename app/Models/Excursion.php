<?php

namespace App\Models;

use App\HasAttachments;
use App\HasFavorites;
use App\HasViews;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Excursion extends Model
{
    use HasAttachments, HasFavorites, HasViews;

    protected $fillable = [
        'name', 'slug', 'description', 'type', 'duration',
        'distance', 'difficulty', 'group_size_min', 'group_size_max',
        'price_adult', 'price_child', 'price_group', 'is_free',
        'age_restriction', 'meeting_point', 'meeting_address', 'schedule_type',
        'operator_name', 'operator_phone', 'booking_enabled', 'rating', 'views_count', 'status', 'views_count',
    ];

    public function points(): HasMany
    {
        return $this->hasMany(ExcursionPoint::class)->orderBy('order');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function guide(): BelongsTo
    {
        return $this->belongsTo(GuidedTour::class, 'guided_tour_id');
    }

    public function getDuration(): int
    {
        return $this->duration ?? $this->points->sum('duration_minutes');
    }
}
