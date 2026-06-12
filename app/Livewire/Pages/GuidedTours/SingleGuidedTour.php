<?php

namespace App\Livewire\Pages\GuidedTours;

use App\Models\GuidedTour;
use Livewire\Component;

class SingleGuidedTour extends Component
{
    public $guidedTour;

    public function mount(GuidedTour $guidedTour)
    {
        $this->guidedTour = $guidedTour;
        $this->guidedTour->load('attachments');
    }

    public function render()
    {
        return view('livewire.pages.guided-tours.single-guided-tour');
    }
}
