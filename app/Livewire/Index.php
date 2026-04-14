<?php

namespace App\Livewire;

use App\Models\Attraction;
use Livewire\Component;
class Index extends Component
{
    public $carouselAttractions;
    public $featuredAttractions;

    public function mount()
    {
        $this->carouselAttractions = Attraction::query()
            ->where('display_location', 'carousel')
            ->with('attachments')
            ->get();

        $this->featuredAttractions = Attraction::query()
            ->where('display_location', 'featured')
            ->with('attachments')
            ->limit(2)
            ->get();
    }

    public function render()
    {
        return view('livewire.index');
    }
}
