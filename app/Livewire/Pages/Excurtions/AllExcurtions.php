<?php

namespace App\Livewire\Pages\Excurtions;

use App\Models\Excurtion;
use Livewire\Component;

class AllExcurtions extends Component
{
    public $excursions;

    public function mount() {
        $this->excursions = Excurtion::all();
    }

    public function render()
    {
        return view('livewire.pages.excurtions.all-excurtions');
    }
}
