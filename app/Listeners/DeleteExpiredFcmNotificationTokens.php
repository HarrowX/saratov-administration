<?php

namespace App\Listeners;

use App\Jobs\UnbindFirebaseTokenJob;
use App\Models\User;
use Illuminate\Notifications\Events\NotificationFailed;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use NotificationChannels\Fcm\FcmChannel;

class DeleteExpiredFcmNotificationTokens
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(NotificationFailed $event): void
    {
        if ($event->channel !== FcmChannel::class) {
            return;
        }

        $report = Arr::get($event->data, 'report');

        if (! is_object($report) || ! method_exists($report, 'target')) {
            Log::warning('Report has no method called `target`', [
                'report' => $report
            ]);
            return;
        }

        $target = $report->target();

        if (! is_object($target) || ! method_exists($target, 'value')) {
            Log::warning('Target has no method called `value`', [
                'target' => $target,
            ]);
            return;
        }

        $notifiableUser = $event->notifiable;
        $deviceToken = $target->value();

        if ($notifiableUser instanceof User && is_string($deviceToken)) {
            UnbindFirebaseTokenJob::dispatch($notifiableUser?->id ?? -1, $deviceToken);
        } else {
            Log::warning('Unable to delete expired fcm notification token', [
                'reason' => 'notifiable or device_token have wrong types',
                'notifiable' => $notifiableUser instanceof User ? $notifiableUser?->id : get_class($notifiableUser),
                'device_token' => $deviceToken,
            ]);
        }
    }
}
