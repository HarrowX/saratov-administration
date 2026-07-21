<?php

namespace App\Livewire\Pages\Events;

use App\Models\Category;
use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class AllEvents extends Component
{
    use WithPagination;

    public $date = '';
    public $search = '';
    public $categoryId = '';
    public $ageRestriction = '';
    public $location = '';

    protected $queryString = [
        'date' => ['except' => ''],
        'search' => ['except' => ''],
        'categoryId' => ['except' => ''],
        'ageRestriction' => ['except' => ''],
        'location' => ['except' => ''],

    ];

    public function mount()
    {
        if (request()->has('date')) {
            $this->date = request('date');
        }
        if (request()->has('category')) {
            $this->categoryId = request('category');
        }
        if (request()->has('age')) {
            $this->ageRestriction = request('age');
        }
        if (request()->has('location')) {
            $this->location = request('location');
        }
    }

    public function render()
    {
        $categories = Category::where('is_active', true)
            ->get();
        $events = Event::query()
            ->with('categories', 'attachments')
            ->when($this->date, function ($query) {
                return $query->whereDate('start_date', $this->date);
            })
            ->when($this->search, function ($query) {
                return $query->where('name', 'like', '%'.$this->search.'%');
            })
            ->when($this->categoryId, function ($query) {
                return $query->whereHas('categories', function ($q) {
                    $q->where('categories.id', $this->categoryId);
                });
            })
            ->when($this->ageRestriction, function ($query) {
                if ($this->ageRestriction === '0') {
                    return $query->whereNull('age_restriction')
                        ->orWhere('age_restriction', '0');
                }
                return $query->where('age_restriction', $this->ageRestriction);
            })
            ->when($this->location, function ($query) {
                return $query->where('address', 'like', '%' . $this->location . '%');
            })
            ->orderBy('start_date')
            ->paginate(12);

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
        $this->ageRestriction = '';
        $this->location = '';
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
