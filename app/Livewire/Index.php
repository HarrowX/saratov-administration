<?php

namespace App\Livewire;

use App\Models\Hotel;
use App\Models\Place;
use App\Models\Restaurant;
use Livewire\Component;
use App\Models\Attraction;
class Index extends Component
{
    public $attractions;
    public $hotels;
    public $restaurants;
    public function mount()
    {
        $this->attractions = Attraction::where('status', 'active')->get();
        $this->hotels = Hotel::all();
        $this->restaurants = Restaurant::all();
    }

    public function render()
    {
        return view('livewire.index');
    }
}
