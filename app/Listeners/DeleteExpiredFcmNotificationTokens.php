<?php

namespace App\Listeners;

use App\Models\User;
use App\Services\FirebaseDeviceTokensService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Events\NotificationFailed;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use NotificationChannels\Fcm\FcmChannel;

class DeleteExpiredFcmNotificationTokens implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(
        protected FirebaseDeviceTokensService $firebaseDeviceTokensService,
    ) {}

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
            $notifiableUser = $event->notifiable;
            $deviceToken = $target->value();
            if ($notifiableUser instanceof User && is_string($deviceToken)) {
                $this->firebaseDeviceTokensService->unbindToken($event->notifiable, $target->value(), soft: false);
            } else {
                Log::warning('Unable to delete expired fcm notification token', [
                    'reason' => 'notifiable or device_token have wrong types',
                    'notifiable' => $notifiableUser,
                    'device_token' => $deviceToken,
                ]);
            }
        }
    }
}
