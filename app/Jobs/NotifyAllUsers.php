<?php

namespace App\Jobs;

use App\HasFcmView;
use App\Models\FirebaseDeviceToken;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Kreait\Laravel\Firebase\Facades\Firebase;

class NotifyAllUsers implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected HasFcmView $notification) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        User::all()->each(function (User $user) {
            $user->notify($this->notification);
        });

        $deviceTokens = FirebaseDeviceToken::all()->pluck('device_token')->toArray();

        Firebase::messaging()->sendMulticast($this->notification->toFcmMessage(), $deviceTokens);
    }
}
