<?php

namespace App\Livewire;

use App\Enums\VisitedStatus;
use App\Models\Attraction;
use App\Models\Hotel;
use App\Models\PlaceVisit;
use App\Models\Restaurant;
use App\Services\FavoritableService;
use App\Services\PlaceVisitService;
use Livewire\Component;
use Livewire\WithPagination;

class VisitsSection extends Component
{
    use WithPagination;


    protected PlaceVisitService $placeVisitService;
    public $selectedStatus = VisitedStatus::SemiVisited->value;

    public function boot(PlaceVisitService $placeVisitService): void
    {
        $this->placeVisitService = $placeVisitService;
    }

    public function selectStatus($status)
    {
        $this->selectedStatus = $status;
        $this->resetPage();
    }

    public function confirmVisit($id, $type)
    {
        $this->placeVisitService->changeStatus(VisitedStatus::Visited, auth()->id(), $id, $type);
    }

    public function unconfirmVisit($id, $type)
    {
        $this->placeVisitService->changeStatus(VisitedStatus::NotVisited, auth()->id(), $id, $type);
    }

    public function getItemsProperty()
    {
        return PlaceVisit::query()->where([
            'user_id' => auth()->id(),
        ])->latest('updated_at')->where('status', '=', $this->selectedStatus)->paginate(5);
    }

    public function getUrl($slug, $class)
    {
        return match ($class) {
            Attraction::class => route('single-attraction', $slug),
            Hotel::class => route('single-hotel', $slug),
            Restaurant::class => route('single-restaurant', $slug),
        };
    }

    public function render()
    {
        return view('livewire.visits-section');
    }
}
