<?php

namespace App\Livewire;

use App\Models\Attraction;
use App\Models\Hotel;
use App\Models\Restaurant;
use Livewire\Component;

class Index extends Component
{
    public $carouselAttractions;

    public $featuredAttractions;

    public $attractions;

    public $hotels;

    public $restaurants;

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

        $this->attractions = Attraction::where('status', 'active')->get();
        $this->hotels = Hotel::all();
        $this->restaurants = Restaurant::all();
    }

    public function render()
    {
        return view('livewire.index');
    }
}
