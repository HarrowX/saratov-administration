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


    public function render()
    {
        return view('livewire.notification-item');
    }
}
