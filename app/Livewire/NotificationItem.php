<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;

class NotificationItem extends Component
{
    public $notification;

    public $isDrawer = false;

    protected $listeners = ['notificationsUpdated' => '$refresh'];

    public function mount($notification, $isDrawer = false)
    {
        $this->notification = $notification;
        $this->isDrawer = $isDrawer;
    }

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
            'App\Notifications\AIAnswer' => 'fa-robot',
            'App\Notifications\EventCreated' => 'fa-calendar',
            'App\Notifications\NewEventOnFavoritable' => 'fa-heart',
            'App\Notifications\FavoritableEventStartsSoon' => 'fa-clock',
        ];

        return $map[$this->notification->type] ?? 'fa-bell';
    }

    public function getIconColorProperty()
    {
        $map = [
            'App\Notifications\AIAnswer' => 'text-white bg-linear-to-br from-[#1e3a8a] to-[#2663EB]',
            'App\Notifications\EventCreated' => 'text-white bg-linear-to-r from-green-500 to-teal-600',
            'App\Notifications\NewEventOnFavoritable' => 'text-white bg-[#A556F7]',
            'App\Notifications\FavoritableEventStartsSoon' => 'text-white bg-[#2663EB]',
        ];

        return $map[$this->notification->type] ?? 'text-white bg-linear-to-br from-[#A556F7] to-[#2663EB]';
    }

    public function render()
    {
        return view('livewire.notification-item');
    }
}
