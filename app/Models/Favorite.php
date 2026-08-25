<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
    use SoftDeletes;

    public $table = 'favorites';

    public $fillable = [
        'user_id',
        'favoriteable_id',
        'favoriteable_type',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function favoriteable(): MorphTo
    {
        return $this->morphTo();
    }

    public function morphName(): string
    {
        $this->load('favoriteable');
        $type = match ($this->favoriteable_type) {
            Restaurant::class => 'Ресторан',
            Attraction::class => 'Достопримечательность',
            Hotel::class => 'Отель',
            GuidedTour::class => 'Экскурсовод',
            Excursion::class => 'Экскурсия',
            default => '',
        };
        $concatenated = trim(implode(' ', [$type, $this->favoriteable?->name ?? '']));

        return $concatenated === '' ? 'Избранное место' : $concatenated;
    }
}
