<?php

namespace App\Notifications;

use App\HasFcmView;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;

class EventOnFavoriteCreated extends Notification implements HasFcmView, ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public string $eventName,
        public string $startTimeFormatted,
        public string $locationName
    ) {
        $this->onQueue('global_notifications');
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

    public function toFcm(object $notifiable): FcmMessage
    {
        return new FcmMessage(notification: new FcmNotification(
            title: 'Проходит событие '.$this->eventName.' в избранной вами локации: '.$this->locationName,
            body: 'Начало в '.$this->startTimeFormatted,
        ));
    }

    public function toFcmMessage(): FcmMessage
    {
        return new FcmMessage(notification: new FcmNotification(
            title: 'Проходит событие '.$this->eventName.' в избранной вами локации: '.$this->locationName,
            body: 'Начало в '.$this->startTimeFormatted,
        ));
    }
}
