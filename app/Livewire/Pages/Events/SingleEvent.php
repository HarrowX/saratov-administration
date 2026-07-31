<?php

namespace App\Livewire\Pages\Events;

use App\Models\Event;
use Livewire\Component;

class SingleEvent extends Component
{
    public $event;

    public function mount(Event $event)
    {
        $this->event = $event;
        $this->event->load('categories', 'attachments', 'location');
    }

    public function render()
    {
        return view('livewire.pages.events.single-event');
    }
}
