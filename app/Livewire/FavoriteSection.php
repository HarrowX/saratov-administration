<?php

namespace App\Livewire;

use App\Models\Attraction;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Services\FavoritableService;
use Livewire\Component;
use Livewire\WithPagination;

class FavoriteSection extends Component
{
    use WithPagination;

    public $selectedType = Attraction::class;

    protected FavoritableService $favoritableService;

    public function boot(FavoritableService $favoritableService): void
    {
        $this->favoritableService = $favoritableService;
    }

    public function selectType($type)
    {
        $this->selectedType = $type;
        $this->resetPage();
    }

    public function getItemsProperty()
    {
        return $this->selectedType::query()->whereHas('favorites', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->paginate(5);
    }

    public function getUrl($slug)
    {
        return match ($this->selectedType) {
            Attraction::class => route('single-attraction', $slug),
            Hotel::class => route('single-hotel', $slug),
            Restaurant::class => route('single-restaurant', $slug),
        };
    }

    public function unfavorite($id)
    {
        $this->favoritableService->delete(auth()->user()->id, $id, $this->selectedType);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.favorite-section');
    }
}
