<?php

namespace App\Livewire;

use App\Models\Attraction;
use Livewire\Component;

class AttractionComponent extends Component
{
    public $attractions;

    public $longitude;

    public $latitude;

    public function mount()
    {
        $this->attractions = Attraction::with('attachments')
            ->get()
            ->filter(function (Attraction $attraction) {
                return static::vincentyGreatCircleDistance(
                    $this->latitude, $this->longitude,
                    $attraction->latitude, $attraction->longitude)
                    <= config('app.attractions.radius');
            });
    }

    //    public function mount($latitude = null, $longitude = null) {
    //        $this->latitude = $latitude;
    //        $this->longitude = $longitude;
    //        $this->attractions = Attraction::with('attachments')->get();
    //    }
    public function render()
    {
        return view('livewire.attraction-component');
    }

    public static function vincentyGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);
        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) +
            pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
        $angle = atan2(sqrt($a), $b);

        return $angle * $earthRadius;
    }
}
