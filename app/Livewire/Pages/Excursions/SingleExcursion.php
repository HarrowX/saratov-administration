<?php

namespace App\Livewire\Pages\Excursions;

use App\Models\Attraction;
use App\Models\Excursion;
use App\Models\Hotel;
use App\Models\Restaurant;
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

    public array $attractions;

    public array $hotels;

    public array $restaurants;

    public array $startPosition;

    public function boot(FavoritableService $favoritableService, ViewService $viewService): void
    {
        $this->favoritableService = $favoritableService;
        $this->viewService = $viewService;
    }

    public function mount(Excursion $excursion)
    {
        $this->excursion = $excursion;
        $this->excursion->load('attachments');

        $this->attractions = $excursion->points
            ->where('pointable_type', Attraction::class)
            ->map(fn ($point) => $point->pointable)
            ->values()
            ->toArray();

        $this->hotels = $excursion->points
            ->where('pointable_type', Hotel::class)
            ->map(fn ($point) => $point->pointable)
            ->values()
            ->toArray();

        $this->restaurants = $excursion->points
            ->where('pointable_type', Restaurant::class)
            ->map(fn ($point) => $point->pointable)
            ->values()
            ->toArray();

        $firstPlace = $excursion->points()->orderBy('order')->first();

        $this->startPosition = [$firstPlace->pointable->latitude, $firstPlace->pointable->longitude];

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
