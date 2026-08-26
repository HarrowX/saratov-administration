<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserName extends Model
{
    use SoftDeletes;

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

    public function toFio(): string
    {
        return $this->surname.' '.$this->name.' '.$this->patronymic;
    }
}
