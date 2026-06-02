<?php

namespace App\Livewire\Pages\Excursions;

use App\Models\Excursion;
use Livewire\Component;

class SingleExcursion extends Component
{
    public $excursion;
    public $nearbyLatitude;
    public $nearbyLongitude;
    public function mount(Excursion $excursion) {
        $this->excursion = $excursion;
        $this->excursion->load('attachments');
    }
    public function render()
    {
        return view('livewire.pages.excursions.single-excursion');
    }
}
