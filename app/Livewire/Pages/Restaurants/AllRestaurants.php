<?php

namespace App\Livewire\Pages\Restaurants;

use App\Models\Restaurant;
use Livewire\Component;

class AllRestaurants extends Component
{
    public $restaurants;

    public function mount() {
        $this->restaurants = Restaurant::with('attachments')->get();
    }
    public function render()
    {
        return view('livewire.pages.restaurants.all-restaurants');
    }
}
