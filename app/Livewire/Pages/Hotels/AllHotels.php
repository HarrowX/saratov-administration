<?php

namespace App\Livewire\Pages\Hotels;

use App\Models\Hotel;
use Livewire\Component;

class AllHotels extends Component
{
    public $hotels;

    public function mount()
    {
        $this->hotels = Hotel::with('attachments')->get();
    }

    public function render()
    {
        return view('livewire.pages.hotels.all-hotels');
    }
}
