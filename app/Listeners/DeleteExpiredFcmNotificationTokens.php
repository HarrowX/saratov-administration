<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Events\NotificationFailed;
use Illuminate\Support\Arr;
use NotificationChannels\Fcm\FcmChannel;

class DeleteExpiredFcmNotificationTokens implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    public function viaQueue(): string
    {
        return 'listeners';
    }

    /**
     * Handle the event.
     */
    public function handle(NotificationFailed $event): void
    {
        if ($event->channel == FcmChannel::class) {

            $report = Arr::get($event->data, 'report');

            $target = $report->target();

            $event->notifiable->firebaseDeviceTokens()
                ->where('device_token', $target->value())
                ->delete();
        }
    }
}
