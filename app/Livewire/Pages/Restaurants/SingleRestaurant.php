<?php

namespace App\Livewire\Pages\Restaurants;

use App\Models\Restaurant;
use App\Services\FavoritableService;
use App\Services\ViewService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SingleRestaurant extends Component
{
    public $restaurant;

    public int $favoritesCount = 0;

    public $isFavorite = false;

    protected FavoritableService $favoritableService;

    protected ViewService $viewService;

    public function boot(FavoritableService $favoritableService, ViewService $viewService): void
    {
        $this->favoritableService = $favoritableService;
        $this->viewService = $viewService;
    }

    public function mount(Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
        $this->restaurant->load('attachments');
        $this->favoritesCount = $restaurant->favorites?->count() ?? 0;
        if (Auth::check()) {
            $this->isFavorite = $restaurant->favorites->contains('user_id', auth()->id());
        }
        $this->viewService->calculate($this->restaurant->id, Restaurant::class);

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
            $this->restaurant->id,
            Restaurant::class
        );

        $this->isFavorite = true;
        $this->favoritesCount++;
    }

    public function unfavorite()
    {
        $this->favoritableService->delete(
            auth()->user()->id,
            $this->restaurant->id,
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
