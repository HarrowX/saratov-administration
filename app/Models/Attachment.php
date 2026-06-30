<?php

namespace App\Models;

use App\Models\Scopes\OrderedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Attachment extends Model
{
    protected $fillable = [
        'link',
        'order',
        'attachable_id',
        'attachable_type',
    ];

    public function attachable(): MorphTo
    {
        return $this->morphTo();
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OrderedScope);
    }

    public function url(): string
    {
        if ($this->link) {
            return '/storage/'.$this->link;
        }

        return '';
    }
}
