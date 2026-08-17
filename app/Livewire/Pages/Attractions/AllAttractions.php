<?php

namespace App\Livewire\Pages\Attractions;

use App\Models\Attraction;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class AllAttractions extends Component
{
    use WithPagination;

    #[Computed]
    public function attractions()
    {
        return Attraction::with(['attachments', 'favorites', 'views'])->paginate(15);
    }

    public function render()
    {
        return view('livewire.pages.attractions.all-attractions');
    }
}
