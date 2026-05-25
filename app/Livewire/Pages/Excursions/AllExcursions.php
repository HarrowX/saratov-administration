<?php

namespace App\Livewire\Pages\Excursions;

use App\Models\Excursion;
use Livewire\Component;

class AllExcursions extends Component
{
    public $excursions;

    public function mount() {
        $this->excursions = Excursion::with('attachments')->get();
    }

    public function render()
    {
        return view('livewire.pages.excursions.all-excursions');
    }
}
