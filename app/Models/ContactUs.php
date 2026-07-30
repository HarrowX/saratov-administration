<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactUs extends Model
{
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
