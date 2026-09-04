<?php

namespace App\Jobs;

use App\HasFcmView;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;

class NotifyFavoriteUsers implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected HasFcmView $notification, protected $favoritable) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::send(User::query()->whereHas('favorites',
            fn ($builder) => $builder->where('favoriteable_id', $this->favoritable->id)->where('favoriteable_type', get_class($this->favoritable))
        )->get(), $this->notification);
    }
}
