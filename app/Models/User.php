<?php

namespace App\Models;

use App\Events\UserTrashedEvent;
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
    use CascadeSoftDeletes, HasApiTokens, HasConversations, HasFactory, Notifiable;

    use SoftDeletes {restore as parentRestore; }

    protected $cascadeDeletes = ['username', 'contactUs', 'favorites'];

    public function getCascadeDeletes(): array
    {
        return $this->cascadeDeletes;
    }

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

    protected $dispatchesEvents = [
        'trashed' => UserTrashedEvent::class,
    ];

    public function username(): HasOne
    {
        return $this->hasOne(UserName::class, 'user_id');
    }

    public function contactUs(): HasMany
    {
        return $this->hasMany(ContactUs::class, 'user_id');
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class, 'user_id');
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

    public function restore(): bool
    {
        $deletedAt = $this->deleted_at;
        $success = $this->parentRestore();
        $this->username()->restore();
        $this->contactUs()->restore();
        $this->favorites()->whereBetween('deleted_at', [
            $deletedAt->copy()->subSeconds(5),
            $deletedAt->copy()->addSeconds(5),
        ])->restore();

        return $success;
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
