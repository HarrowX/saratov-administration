<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Notifications\DatabaseNotification;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Notifications\AIAnswer;
use App\Notifications\EventCreated;
use App\Notifications\NewEventOnFavoritable;
class NotificationDrawer extends Component
{
    use WithPagination;

    public $filter = 'all';

    public $isOpen = false;

    public $perPage = 10;

    protected $importantTypes = [
        AIAnswer::class,
        EventCreated::class,
        NewEventOnFavoritable::class,
    ];

    #[On('toggleDrawer')]
    public function toggle()
    {
        $this->isOpen = ! $this->isOpen;
        if ($this->isOpen) {
            $this->perPage = 10;
        }
    }

    #[On('refreshDrawer')]
    #[On('notificationCountUpdated')]
    public function refreshDrawer()
    {
        $this->resetPage();
        $this->dispatch('$refresh');
    }

    public function close()
    {
        $this->isOpen = false;
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function getTotalCountProperty()
    {
        return DatabaseNotification::query()
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', auth()->id())
            ->count();
    }

    public function getHasMoreProperty()
    {
        if ($this->filter === 'unread' || $this->filter === 'important') {
            return false;
        }

        $total = $this->totalCount;
        $loaded = $this->notifications->count();

        return $loaded < $total;
    }

    public function getFilteredCountProperty()
    {
        $query = DatabaseNotification::query()
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', auth()->id());

        if ($this->filter === 'unread') {
            $query->whereNull('read_at');
        } elseif ($this->filter === 'important') {
            return 0;
        }

        return $query->count();
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
        return DatabaseNotification::query()
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', auth()->id())
            ->whereIn('type', $this->importantTypes)
            ->count();
    }

    public function getNotificationsProperty()
    {
        $query = DatabaseNotification::query()
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', auth()->id());

        if ($this->filter === 'unread') {
            $query->whereNull('read_at');
        } elseif ($this->filter === 'important') {
            $query->whereIn('type', $this->importantTypes);
        }
        if ($this->filter === 'all') {
            $query->limit($this->perPage);
        }

        return $query->orderBy('created_at', 'desc')->get();
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
            'hasMore' => $this->hasMore,
            'totalCount' => $this->totalCount,
        ]);
    }
}
