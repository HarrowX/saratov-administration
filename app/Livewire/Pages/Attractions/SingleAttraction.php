<?php

namespace App\Livewire\Pages\Attractions;

use App\Models\Attraction;
use App\Services\FavoritableService;
use App\Services\ViewService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SingleAttraction extends Component
{
    public $attraction;

    public int $favoritesCount = 0;

    public $isFavorite = false;

    protected FavoritableService $favoritableService;

    protected ViewService $viewService;

    public function boot(FavoritableService $favoritableService, ViewService $viewService): void
    {
        $this->favoritableService = $favoritableService;
        $this->viewService = $viewService;
    }

    public function mount(Attraction $attraction)
    {

        $this->attraction = $attraction;
        $this->attraction->load('attachments');
        $this->favoritesCount = $attraction->favorites?->count() ?? 0;

        if (Auth::check()) {
            $this->isFavorite = $attraction->favorites->contains('user_id', auth()->id());
        }

        $this->viewService->calculate($this->attraction->id, Attraction::class);

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
            Attraction::class
        );

        $this->isFavorite = true;
        $this->favoritesCount++;
    }

    public function unfavorite()
    {
        $this->favoritableService->delete(
            auth()->user()->id,
            $this->attraction->id,
            Attraction::class
        );

        $this->isFavorite = false;
        $this->favoritesCount--;
    }

    public function render()
    {
        return view('livewire.pages.attractions.single-attraction');
    }
}
