<?php

namespace App\Jobs;

use App\HasFcmView;
use App\Models\FirebaseDeviceToken;
use App\Models\User;
use App\Notifications\FcmTestNotification;
use AWS\CRT\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Notifications\Notification;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Laravel\Pulse\Users;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\FcmResource;

class NotifyAllUsers implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected HasFcmView $notification) { }

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
