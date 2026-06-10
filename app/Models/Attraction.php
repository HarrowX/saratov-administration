<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Attraction extends Model
{
    protected $fillable = [
        'name',
        'short_description',
        'description',
        'worktime',
        'phone',
        'address',
        'slug',
        'district',
        'latitude',
        'longitude',
        'email',
        'map_link',
        'website',
        'status',
        'ticket_price',
        'visit_duration',
        'is_accessible',
        'has_parking',
        'rating',
        'views_count',
        'favorites_count',
        'created_by',
    ];
    protected $casts = [
        'worktime' => 'array',
    ];
    public function attachments(): MorphMany {
        return $this->morphMany(Attachment::class, 'attachable');
    }
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
