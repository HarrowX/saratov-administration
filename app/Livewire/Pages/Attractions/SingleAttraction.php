<?php

namespace App\Livewire\Pages\Attractions;

use App\Models\Attraction;
use Livewire\Component;

class SingleAttraction extends Component
{
    public $attraction;

    public function mount(Attraction $attraction)
    {
        $this->attraction = $attraction;
        $this->attraction->load('attachments');
    }

    public function render()
    {
        return view('livewire.pages.attractions.single-attraction');
    }
}
