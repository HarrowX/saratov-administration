<?php

namespace App\Livewire\Pages\Hotels;

use App\Models\Hotel;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class AllHotels extends Component
{
    use WithPagination;

    #[Computed]
    public function hotels()
    {
        return Hotel::with(['attachments', 'favorites', 'views'])->paginate(15);
    }

    public function render()
    {
        return view('livewire.pages.hotels.all-hotels');
    }
}
