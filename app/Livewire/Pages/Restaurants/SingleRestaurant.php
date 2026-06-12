<?php

namespace App\Livewire\Pages\Restaurants;

use App\Models\Restaurant;
use Livewire\Component;

class SingleRestaurant extends Component
{
    public $restaurant;

    public function mount(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
        $this->restaurant->load('attachments');
    }

    public function render()
    {
        return view('livewire.pages.restaurants.single-restaurant');
    }
}
