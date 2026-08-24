<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Larahook\SanctumRefreshToken\Trait\HasApiTokens;
use Laravel\Ai\Concerns\HasConversations;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasConversations, HasFactory, Notifiable, SoftDeletes, CascadeSoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'phone',
        'password',
        'vk_id',
        'apple_id',
        'vk_avatar',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function booted(): void
    {
        static::deleting(function (User $user) {
            $user->username()->delete();
        });
    }

    public function username(): HasOne
    {
        return $this->hasOne(UserName::class, 'user_id');
    }

    public function firebaseDeviceTokens(): HasMany
    {
        return $this->hasMany(FirebaseDeviceToken::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function restore(): void
    {
        $this->username()->restore();
    }

    public function haveFakeVkEmail(): bool
    {
        return $this->email == 'vk_'.$this->vk_id.'@'.config('app.domain_name');
    }

    public function routeNotificationForFcm()
    {
        return $this->firebaseDeviceTokens()->pluck('device_token')->toArray();
    }
}
