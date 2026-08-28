<?php

namespace App\Livewire;

use App\Models\Attraction;
use Livewire\Component;

class AttractionComponent extends Component
{
    public $attractions;

    public $longitude;

    public $latitude;

    public $exceptId;

    public function mount()
    {
        $query= Attraction::with('attachments');

        if (!empty($this->exceptId)) {
            $query->where('id','!=',$this->exceptId);
        }

        $this->attractions = $query
            ->selectRaw('*, ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) as distance', [$this->longitude, $this->latitude])
            ->orderBy('distance')
            ->limit(12)
            ->get();
    }

    public function render()
    {
        return view('livewire.attraction-component');
    }
}
