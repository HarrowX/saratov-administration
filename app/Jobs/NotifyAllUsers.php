<?php

namespace App\Jobs;

use App\HasFcmView;
use App\Models\FirebaseDeviceToken;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;
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
        Notification::send(User::all(), $this->notification);

        $deviceTokens = FirebaseDeviceToken::all()->whereNull('user_id')->pluck('device_token')->toArray();

        Firebase::messaging()->sendMulticast($this->notification->toFcmMessage(), $deviceTokens);
    }
}
