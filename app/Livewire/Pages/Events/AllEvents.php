<?php

namespace App\Livewire\Pages\Events;

use App\Models\Event;
use App\Models\EventCategory;
use Livewire\Component;
use Livewire\WithPagination;

class AllEvents extends Component
{
    use WithPagination;

    public $date = '';
    public $search = '';
    public $categoryId = '';

    protected $queryString = [
        'date' => ['except' => ''],
        'search' => ['except' => ''],
        'categoryId' => ['except' => ''],
    ];
    public function mount()
    {
        if (request()->has('date')) {
            $this->date = request('date');
        }
        if (request()->has('category')) {
            $this->categoryId = request('category');
        }
    }
    public function render()
    {
        $categories = EventCategory::where('is_active', true)
            ->orderBy('order')
            ->get();
        $events = Event::query()
            ->with('categories', 'attachments')
            ->when($this->date, function ($query) {
                return $query->whereDate('start_date', $this->date);
            })
            ->when($this->search, function ($query) {
                return $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->categoryId, function ($query) {
                return $query->whereHas('categories', function ($q) {
                    $q->where('categories.id', $this->categoryId);
                });
            })->orderBy('start_date')->paginate(12);

        return view('livewire.pages.events.all-events', [
            'events' => $events,
            'categories' => $categories,
        ]);
    }
    public function clearFilters()
    {
        $this->date = '';
        $this->search = '';
        $this->categoryId = '';
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
