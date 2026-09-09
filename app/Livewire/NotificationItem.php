<?php

namespace App\Livewire;

use App\Models\User;
use App\Notifications\AIAnswer;
use App\Notifications\EventCreated;
use App\Notifications\FavoritableEventStartsSoon;
use App\Notifications\NewEventOnFavoritable;
use Illuminate\Notifications\DatabaseNotification;
use Livewire\Attributes\On;
use Livewire\Component;

class NotificationItem extends Component
{
    public $notification;

    public $isDrawer = false;

    public function mount($notification, $isDrawer = false)
    {
        $this->notification = $notification;
        $this->isDrawer = $isDrawer;
    }

    #[On('notificationsUpdated')]
    public function refresh() {}

    public function markAsRead($notificationId)
    {
        DatabaseNotification::query()
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', auth()->id())
            ->where('id', $notificationId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
        $this->dispatch('notificationCountUpdated');
        $this->dispatch('notificationsUpdated');
        $this->dispatch('refreshDrawer');
    }

    public function deleteNotification($notificationId)
    {
        DatabaseNotification::query()
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', auth()->id())
            ->where('id', $notificationId)
            ->delete();

        $this->dispatch('notificationCountUpdated');
        $this->dispatch('refreshDrawer');
    }

    public function getIconProperty()
    {
        $map = [
            AIAnswer::class => 'fa-robot',
            EventCreated::class => 'fa-calendar',
            NewEventOnFavoritable::class => 'fa-heart',
            FavoritableEventStartsSoon::class => 'fa-clock',
        ];

        return $map[$this->notification->type] ?? 'fa-bell';
    }

    public function getIconColorProperty()
    {
        $map = [
            AIAnswer::class => 'text-white bg-linear-to-br from-[#1e3a8a] to-[#2663EB]',
            EventCreated::class => 'text-white bg-linear-to-r from-green-500 to-teal-600',
            NewEventOnFavoritable::class => 'text-white bg-[#A556F7]',
            FavoritableEventStartsSoon::class => 'text-white bg-[#2663EB]',
        ];

        return $map[$this->notification->type] ?? 'text-white bg-linear-to-br from-[#A556F7] to-[#2663EB]';
    }

    public function render()
    {
        return view('livewire.notification-item');
    }
}
