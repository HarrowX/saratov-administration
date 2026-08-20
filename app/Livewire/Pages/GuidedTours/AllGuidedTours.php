<?php

namespace App\Livewire\Pages\GuidedTours;

use App\Models\GuidedTour;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class AllGuidedTours extends Component
{
    use WithPagination;

    // TODO: Добавить синхронизацию поиска с поисковой строкой браузера
    public $searchString;

    #[Computed]
    public function guidedTours()
    {
        $builder = GuidedTour::with(['attachments', 'favorites', 'views']);

        if (trim($this->searchString)) {
            $builder->where(function ($builder) {
                $builder->whereLike('name', '%'.trim($this->searchString).'%')
                    ->orWhereLike('short_description', '%'.trim($this->searchString).'%')
                    ->orWhereLike('description', '%'.trim($this->searchString).'%');
            });
        }

        return $builder->paginate(15);
    }

    public function loadGuidedTours()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.pages.guided-tours.all-guided-tours');
    }
}
