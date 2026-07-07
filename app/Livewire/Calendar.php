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
                $year = $date->year;
                $month = $date->month - 1;
                $day = $date->day;
                if (!isset($eventsData[$year])) {
                    $eventsData[$year] = [];
                }
                if (!isset($eventsData[$year][$month])) {
                    $eventsData[$year][$month] = [];
                }
                if (!isset($eventsData[$year][$month][$day])) {
                    $eventsData[$year][$month][$day] = 0;
                }
                $eventsData[$year][$month][$day]++;
            }
        }

        return view('livewire.calendar', [
            'eventsData' => json_encode($eventsData),
        ]);
    }
}
