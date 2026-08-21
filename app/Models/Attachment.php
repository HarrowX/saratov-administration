<?php

namespace App\Models;

use App\Models\Scopes\OrderedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

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

    public function getThumbUrl(): string
    {
        if (Storage::exists('thumb_' . $this->link)) return false;
        return asset(Storage::url('thumb_' . $this->link));
    }
    public function getUrl(): string
    {
        return asset(Storage::url($this->link)); // отличается от url() тем что есть доменное имя сайта с протоколом
    }
}
