<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;

class NotificationCounter extends Component
{
    public $count = 0;

    protected $listeners = ['notificationCountUpdated' => 'refreshCount'];

    public function mount()
    {
        $this->refreshCount();
    }

    public function refreshCount()
    {
        $this->count = DatabaseNotification::query()
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', auth()->id())
            ->whereNull('read_at')
            ->count();
    }

    public function render()
    {
        return view('livewire.notification-counter');
    }
}
