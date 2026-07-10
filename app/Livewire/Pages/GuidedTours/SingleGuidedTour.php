<?php

namespace App\Livewire\Pages\GuidedTours;

use App\Models\GuidedTour;
use App\Services\FavoritableService;
use App\Services\ViewService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SingleGuidedTour extends Component
{
    public $guidedTour;

    public int $favoritesCount = 0;

    public $isFavorite = false;

    protected FavoritableService $favoritableService;

    protected ViewService $viewService;

    public function boot(FavoritableService $favoritableService, ViewService $viewService): void
    {
        $this->favoritableService = $favoritableService;
        $this->viewService = $viewService;
    }

    public function mount(GuidedTour $guidedTour)
    {
        $this->guidedTour = $guidedTour;
        $this->guidedTour->load('attachments');

        $this->favoritesCount = $guidedTour->favorites?->count() ?? 0;

        if (Auth::check()) {
            $this->isFavorite = $guidedTour->favorites->contains('user_id', auth()->id());
        }

        $this->viewService->calculate($this->guidedTour->id, GuidedTour::class);
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
            $this->guidedTour->id,
            GuidedTour::class
        );

        $this->isFavorite = true;
        $this->favoritesCount++;
    }

    public function unfavorite()
    {
        $this->favoritableService->delete(
            auth()->user()->id,
            $this->guidedTour->id,
            GuidedTour::class
        );

        $this->isFavorite = false;
        $this->favoritesCount--;
    }

    public function render()
    {
        return view('livewire.pages.guided-tours.single-guided-tour');
    }
}
