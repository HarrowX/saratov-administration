<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;
use Livewire\Attributes\On;

class NotificationCounter extends Component
{
    public $count = 0;

    public function mount()
    {
        $this->refreshCount();
    }
    #[On('notificationCountUpdated')]
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
