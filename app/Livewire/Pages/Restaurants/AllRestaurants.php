<?php

namespace App\Livewire\Pages\Restaurants;

use App\Models\Restaurant;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class AllRestaurants extends Component
{
    use WithPagination;

    #[Computed]
    public function restaurants()
    {
        return Restaurant::with(['attachments', 'favorites', 'views'])->paginate(15);
    }

    public function render()
    {
        return view('livewire.pages.restaurants.all-restaurants');
    }
}
