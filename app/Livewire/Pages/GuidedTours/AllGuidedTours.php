<?php

namespace App\Livewire\Pages\GuidedTours;

use App\Models\GuidedTour;
use Livewire\Component;

class AllGuidedTours extends Component
{
    public $guidedTours;

    // TODO: Добавить синхронизацию поиска с поисковой строкой браузера
    public $searchString;

    public function mount()
    {
        $this->loadGuidedTours();
    }

    public function loadGuidedTours()
    {
        $builder = GuidedTour::with('attachments');

        if (trim($this->searchString)) {
            $builder->where(function ($builder) {
                $builder->whereLike('name', '%'.trim($this->searchString).'%')
                    ->orWhereLike('short_description', '%'.trim($this->searchString).'%')
                    ->orWhereLike('description', '%'.trim($this->searchString).'%');
            });
        }
        $this->guidedTours = $builder->get();
    }

    public function render()
    {
        return view('livewire.pages.guided-tours.all-guided-tours');
    }
}
