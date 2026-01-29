<?php

namespace App\Livewire;

use App\Models\Place;
use Livewire\Component;

class Index extends Component
{
    public $places;

    public function mount() {
        $this->places = Place::all();
    }
    public function render()
    {
        return view('livewire.index');
    }
}
