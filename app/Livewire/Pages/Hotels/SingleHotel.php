<?php

namespace App\Livewire\Pages\Hotels;

use App\Models\Hotel;
use App\Services\FavoritableService;
use App\Services\ViewService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SingleHotel extends Component
{
    public $hotel;

    public int $favoritesCount = 0;

    public $isFavorite = false;

    protected FavoritableService $favoritableService;

    protected ViewService $viewService;

    public function boot(FavoritableService $favoritableService, ViewService $viewService): void
    {
        $this->favoritableService = $favoritableService;
        $this->viewService = $viewService;
    }

    public function mount(Hotel $hotel)
    {
        $this->hotel = $hotel;
        $this->hotel->load('attachments');
        $this->favoritesCount = $hotel->favorites?->count() ?? 0;
        if (Auth::check()) {
            $this->isFavorite = $hotel->favorites->contains('user_id', auth()->id());
        }
        $this->viewService->calculate($this->hotel->id, Hotel::class);

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
            $this->hotel->id,
            Hotel::class
        );

        $this->isFavorite = true;
        $this->favoritesCount++;
    }

    public function unfavorite()
    {
        $this->favoritableService->delete(
            auth()->user()->id,
            $this->hotel->id,
            Hotel::class
        );

        $this->isFavorite = false;
        $this->favoritesCount--;
    }

    public function render()
    {
        return view('livewire.pages.hotels.single-hotel');
    }
}
