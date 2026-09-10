<?php

namespace App\Livewire\Pages\Excursions;

use App\Models\Excursion;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class AllExcursions extends Component
{
    use WithPagination;

    #[Computed]
    public function excursions()
    {
        return Excursion::with(['attachments', 'favorites', 'views'])->paginate(15);
    }

    public function render()
    {
        return view('livewire.pages.excursions.all-excursions');
    }
}
