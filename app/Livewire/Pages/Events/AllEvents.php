<?php

namespace App\Livewire\Pages\Events;

use App\Models\Attraction;
use App\Models\Category;
use App\Models\CustomLocation;
use App\Models\Event;
use App\Models\Hotel;
use App\Models\Restaurant;
use Livewire\Component;
use Livewire\WithPagination;

class AllEvents extends Component
{
    use WithPagination;

    public $date = '';
    public $search = '';
    public $categoryId = '';
    public $ageRestriction = '';

    public $locationSearch = '';
    public $locationResults = [];
    public $selectedLocation = null;

    protected $queryString = [
        'date' => ['except' => ''],
        'search' => ['except' => ''],
        'categoryId' => ['except' => ''],
        'ageRestriction' => ['except' => ''],
        'selectedLocation' => ['except' => ''],

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
        if (request()->has('selectedLocation')) {
            $this->selectedLocation = request('selectedLocation');
        }
    }
    public function updatedLocationSearch()
    {
        if (strlen($this->locationSearch) >= 2) {
            $this->locationResults = collect()
                ->merge(Attraction::where('name', 'like', '%' . $this->locationSearch . '%')->get())
                ->merge(Hotel::where('name', 'like', '%' . $this->locationSearch . '%')->get())
                ->merge(Restaurant::where('name', 'like', '%' . $this->locationSearch . '%')->get())
                ->merge(CustomLocation::where('name', 'like', '%' . $this->locationSearch . '%')->get());
        } else {
            $this->locationResults = collect();
        }
    }
    public function selectLocation($id)
    {
        $location = collect()
            ->merge(Attraction::all())
            ->merge(Hotel::all())
            ->merge(Restaurant::all())
            ->merge(CustomLocation::all())
            ->firstWhere('id', $id);

        $this->selectedLocation = $id;
        $this->locationSearch = $location?->name ?? '';
        $this->locationResults = collect();
    }


    public function render()
    {
        $categories = Category::where('is_active', true)
            ->get();
        $events = Event::query()
            ->with('categories', 'attachments', 'location')
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
            ->when($this->selectedLocation, function ($query) {
                return $query->whereHas('location', function ($q) {
                    $q->where('id', $this->selectedLocation);
                });
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
        $this->selectedLocation = null;
        $this->locationSearch = '';
        $this->locationResults = collect();
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
