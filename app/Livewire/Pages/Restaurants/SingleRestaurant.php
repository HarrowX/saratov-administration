<?php

namespace App\Livewire\Pages\Restaurants;

use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SingleRestaurant extends Component
{
    public $restaurant;

    public int $favoritesCount = 0;

    public $isFavorite = false;

    public function mount(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
        $this->restaurant->load('attachments');
        $this->favoritesCount = $restaurant->favorites?->count() ?? 0;
        if (Auth::check()) {
            $this->isFavorite = $restaurant->favorites->contains('user_id', auth()->id());
        }
    }

    public function toggleFavorite()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if ($this->isFavorite) {
            $this->unfavorite();
        } else {
            $this->favorite();
        }
    }

    public function favorite()
    {
        $this->favoritableService->save(
            auth()->user()->id,
            $this->attraction->id,
            Restaurant::class
        );

        $this->isFavorite = true;
        $this->favoritesCount++;
    }

    public function unfavorite()
    {
        $this->favoritableService->delete(
            auth()->user()->id,
            $this->attraction->id,
            Restaurant::class
        );

        $this->isFavorite = false;
        $this->favoritesCount--;
    }

    public function render()
    {
        return view('livewire.pages.restaurants.single-restaurant');
    }
}
