<?php

namespace App\Livewire\Pages\Events;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class AllEvents extends Component
{
    use WithPagination;

    public $date = '';
    public $search = '';

    protected $queryString = [
        'date' => ['except' => ''],
        'search' => ['except' => ''],
    ];
    public function mount()
    {
        if (request()->has('date')) {
            $this->date = request('date');
        }
    }
    public function render()
    {
        $events = Event::query()
            ->when($this->date, function ($query) {
                return $query->whereDate('start_date', $this->date);
            })
            ->when($this->search, function ($query) {
                return $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('start_date')
            ->paginate(12);

        return view('livewire.pages.events.all-events', [
            'events' => $events,
        ]);
    }
    public function clearFilters()
    {
        $this->date = '';
        $this->search = '';
        $this->resetPage();
    }
    public function getFormattedDateAttribute()
    {
        if ($this->date) {
            return \Carbon\Carbon::parse($this->date)->format('d.m.Y');
        }
        return null;
    }
}
