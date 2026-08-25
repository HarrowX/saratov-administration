<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    use SoftDeletes;

    protected $table = 'contact_us';

    protected $fillable = [
        'user_id',
        'message',
        'is_processed',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
