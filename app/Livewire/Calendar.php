<?php

namespace App\Livewire;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;

class Calendar extends Component
{
    public function render()
    {
        $events = Event::all();

        $eventsData = [];
        foreach ($events as $event) {
            if($event->start_date){
                $date = Carbon::parse($event->start_date);
                $month = $date->month - 1;
                $day = $date->day;
                if (!isset($eventsData[$month][$day])) {
                    $eventsData[$month][$day] = 0;
                }
                $eventsData[$month][$day]++;
            }
        }

        return view('livewire.calendar', [
            'eventsData' => json_encode($eventsData),
        ]);
    }
}
