<?php

namespace App\Livewire;

use App\Exceptions\AlreadyExistsException;
use App\Models\Attraction;
use App\Models\Excursion;
use App\Models\Favorite;
use App\Models\GuidedTour;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Services\FavoritableService;
use Livewire\Component;
use Livewire\WithPagination;

class HistoryViews extends Component
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

    public function favorite($id)
    {
        try {
            $this->favoritableService->save(auth()->id(), $id, $this->selectedType);
        } catch (AlreadyExistsException $e) {
            // Уже в избранном — просто перерисовываем состояние
        }
    }

    public function getFavoritedIdsProperty(): array
    {
        return Favorite::query()
            ->where('user_id', auth()->id())
            ->where('favoriteable_type', $this->selectedType)
            ->pluck('favoriteable_id')
            ->all();
    }

    public function getItemsProperty()
    {
        return $this->selectedType::query()
            ->with('views')
            ->whereHas('views', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->withMax('views', 'updated_at')
            ->orderByDesc('views_max_updated_at')
            ->paginate(9);
    }

    public function getUrl($item)
    {
        return match ($this->selectedType) {
            Attraction::class => route('single-attraction', $item),
            Hotel::class => route('single-hotel', $item),
            Restaurant::class => route('single-restaurant', $item),
            Excursion::class => route('single-excursion', $item),
            GuidedTour::class => route('single-guided-tour', $item),
        };
    }

    public function render()
    {
        return view('livewire.history-views');
    }
}
