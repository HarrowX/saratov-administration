<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserName extends Model
{
    protected $table = 'user_names';
    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'user_id',
    ];
    protected $guarded = [
    ];

    protected $primaryKey = 'user_id';
}
