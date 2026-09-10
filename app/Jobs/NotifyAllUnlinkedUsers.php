<?php

namespace App\Jobs;

use App\HasFcmView;
use App\Models\FirebaseDeviceToken;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Kreait\Laravel\Firebase\Facades\Firebase;

class NotifyAllUnlinkedUsers implements ShouldQueue
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
        $deviceTokens = FirebaseDeviceToken::all()->whereNull('user_id')->pluck('device_token')->toArray();

        Firebase::messaging()->sendMulticast($this->notification->toFcmMessage(), $deviceTokens);
    }
}
