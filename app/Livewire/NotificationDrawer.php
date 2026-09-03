<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;
use Livewire\WithPagination;

class NotificationDrawer extends Component
{
    use WithPagination;

    public $filter = 'all';
    public $isOpen = false;

    protected $listeners = [
        'toggleDrawer' => 'toggle',
        'refreshDrawer' => 'refreshDrawer'
    ];
    public function refreshDrawer()
    {
        $this->resetPage();
        $this->dispatch('$refresh');
    }

    public function toggle()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function close()
    {
        $this->isOpen = false;
    }

    public function getUnreadCountProperty()
    {
        return DatabaseNotification::query()
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', auth()->id())
            ->whereNull('read_at')
            ->count();
    }

    public function getImportantCountProperty()
    {
        return 0;
    }

    public function getNotificationsProperty()
    {
        $query = DatabaseNotification::query()
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', auth()->id());

        if ($this->filter === 'unread') {
            $query->whereNull('read_at');
        } elseif ($this->filter === 'important') {
            return collect();
        }

        return $query->orderBy('created_at', 'desc')->paginate(8);
    }

    public function getGroupsProperty()
    {
        $notifications = $this->notifications;

        $groups = [
            'today' => collect(),
            'yesterday' => collect(),
            'earlier' => collect(),
        ];

        foreach ($notifications as $notification) {
            $date = Carbon::parse($notification->created_at);
            if ($date->isToday()) {
                $groups['today']->push($notification);
            } elseif ($date->isYesterday()) {
                $groups['yesterday']->push($notification);
            } else {
                $groups['earlier']->push($notification);
            }
        }

        return $groups;
    }

    public function markAllAsRead()
    {
        DatabaseNotification::query()
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $this->dispatch('notificationCountUpdated');
        $this->dispatch('notificationsUpdated');
    }

    public function getHasReadProperty()
    {
        return DatabaseNotification::query()
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', auth()->id())
            ->whereNotNull('read_at')
            ->exists();
    }
    public function deleteAllRead()
    {
        DatabaseNotification::query()
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', auth()->id())
            ->whereNotNull('read_at')
            ->delete();

        $this->dispatch('notificationCountUpdated');
        $this->dispatch('notificationsUpdated');
    }

    public function render()
    {
        return view('livewire.notification-drawer', [
            'notifications' => $this->notifications,
            'groups' => $this->groups,
            'unreadCount' => $this->unreadCount,
            'importantCount' => $this->importantCount,
            'filter' => $this->filter,
            'hasRead' => $this->hasRead,
        ]);
    }
}
