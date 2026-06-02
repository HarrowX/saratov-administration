<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'website',
        'status',
        'ticket_price',
        'visit_duration',
        'accessibility',
        'parking',
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
    public function excursionPoints()
    {
        return $this->morphMany(ExcursionPoint::class, 'pointable');
    }
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
