<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Channels\DatabaseChannel;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;

class FavoritableEventStartsSoon extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public string $eventName,
        public string $startTimeFormatted,
    ) {
        $this->onQueue('notifications');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [FcmChannel::class, DatabaseChannel::class];
    }

    public function toFcm(object $notifiable): FcmMessage
    {
        return new FcmMessage(notification: new FcmNotification(
            title: 'Событие '.$this->eventName,
            body: 'Начало в '.$this->startTimeFormatted,
        ));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'notifiable_id' => $notifiable->getKey(),
            'type' => get_class($this),
            'title' => 'Событие '.$this->eventName,
            'body' => 'Начало в '.$this->startTimeFormatted,
        ];
    }
}
