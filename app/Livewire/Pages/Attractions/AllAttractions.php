<?php

namespace App\Livewire\Pages\Attractions;

use App\Models\Attraction;
use Livewire\Component;
use Livewire\WithPagination;

class AllAttractions extends Component
{
    use WithPagination;
    public $attractions;

    public function mount()
    {
        $this->attractions = Attraction::with(['attachments', 'favorites', 'views'])->get();
    }

    public function render()
    {
        return view('livewire.pages.attractions.all-attractions');
    }
}
