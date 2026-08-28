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
            ->whereRaw('ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) <= ?', [
                $this->longitude, $this->latitude, config('app.attractions.radius'),
            ])
            ->limit(12)
            ->get();

        if ($this->attractions->isEmpty()) {
            $query = Attraction::with('attachments');
            if (!empty($this->exceptId)) {
                $query->where('id', '!=', $this->exceptId);
            }
            $this->attractions = $query
                ->whereRaw('ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) <= ?', [
                    $this->longitude, $this->latitude, (int)config('app.attractions.radius') > 20_000 ? (int) config('app.attractions.radius') * 10 : 20_000,
                ])
                ->limit(12)
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.attraction-component');
    }
}
