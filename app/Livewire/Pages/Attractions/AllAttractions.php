<?php

namespace App\Livewire\Pages\Attractions;

use App\Models\Attraction;
use Livewire\Component;

class AllAttractions extends Component
{
    public $attractions;

    public function mount() {
        $this->attractions = Attraction::with('attachments')->get();
    }
    public function render()
    {
        return view('livewire.pages.attractions.all-attractions');
    }
}
