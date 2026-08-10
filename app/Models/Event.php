<?php

namespace App\Models;

use App\HasAttachments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Event extends Model
{
    use HasAttachments;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'age_restriction',
        'start_date',
        'end_date',
        'organizer_name',
        'organizer_phone',
        'organizer_email',
        'organizer_website',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'event_categories', 'event_id', 'category_id');
    }

    public function eventable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
