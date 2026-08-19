<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;

class NewEventOnFavoritable extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public string $favoritableName,
        public string $eventName,
        public string $eventStartDatetimeFormatted
    ) {
        $this->onQueue('notifications');
        $this->afterCommit();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [FcmChannel::class];
    }

    public function toFcm($notifiable): FcmMessage
    {
        return new FcmMessage(notification: new FcmNotification(
            title: $this->favoritableName,
            body: 'Запланировано новое событие '.$this->eventName.' на '.$this->eventStartDatetimeFormatted,
        ));
    }
}
