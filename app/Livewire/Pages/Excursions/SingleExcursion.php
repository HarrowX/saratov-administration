<?php

namespace App\Livewire\Pages\Excursions;

use App\Models\Excursion;
use App\Services\FavoritableService;
use App\Services\ViewService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SingleExcursion extends Component
{
    public $excursion;

    public $nearbyLatitude;

    public $nearbyLongitude;

    public int $favoritesCount = 0;

    public $isFavorite = false;

    protected FavoritableService $favoritableService;

    protected ViewService $viewService;

    public function boot(FavoritableService $favoritableService, ViewService $viewService): void
    {
        $this->favoritableService = $favoritableService;
        $this->viewService = $viewService;
    }

    public function mount(Excursion $excursion)
    {
        $this->excursion = $excursion;
        $this->excursion->load('attachments');
        $this->favoritesCount = $excursion->favorites?->count() ?? 0;

        if (Auth::check()) {
            $this->isFavorite = $excursion->favorites->contains('user_id', auth()->id());
        }

        $this->viewService->calculate($this->excursion->id, Excursion::class);
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
            $this->excursion->id,
            Excursion::class
        );

        $this->isFavorite = true;
        $this->favoritesCount++;
    }

    public function unfavorite()
    {
        $this->favoritableService->delete(
            auth()->user()->id,
            $this->excursion->id,
            Excursion::class
        );

        $this->isFavorite = false;
        $this->favoritesCount--;
    }

    public function render()
    {
        return view('livewire.pages.excursions.single-excursion');
    }
}
