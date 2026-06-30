<?php

namespace App\Livewire;

use App\Models\Attraction;
use App\Models\Hotel;
use App\Models\Restaurant;
use Livewire\Component;
use Livewire\WithPagination;

class HistoryViews extends Component
{
    use WithPagination;

    public $selectedType = Attraction::class;

    public function selectType($type)
    {
        $this->selectedType = $type;
        $this->resetPage();
    }

    public function getItemsProperty()
    {
        $model = new $this->selectedType;
        $tableName = $model->getTable();

        return $this->selectedType::query()
            ->join('history_views', 'history_views.viewable_id', '=', $tableName.'.id')
            ->where('history_views.viewable_type', $this->selectedType)
            ->where('history_views.user_id', auth()->user()->id)
            ->orderBy('history_views.updated_at', 'desc')
            ->paginate(5);
    }

    public function getUrl($slug)
    {
        return match ($this->selectedType) {
            Attraction::class => route('single-attraction', $slug),
            Hotel::class => route('single-hotel', $slug),
            Restaurant::class => route('single-restaurant', $slug),
        };
    }

    public function render()
    {
        return view('livewire.history-views');
    }
}
