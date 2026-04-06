<?php

namespace App\Livewire\Pages\Hotels;

use App\Models\Hotel;
use Livewire\Component;

class SingleHotel extends Component
{
    public $hotel;
    public function mount(Hotel $hotel) {
        $this->hotel = $hotel;
        $this->hotel->load('attachments');
    }
    public function render()
    {
        return view('livewire.pages.hotels.single-hotel');
    }
}
