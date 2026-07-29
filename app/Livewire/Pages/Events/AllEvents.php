<?php

namespace App\Livewire\Pages\Events;

use App\Models\Attraction;
use App\Models\Category;
use App\Models\CustomLocation;
use App\Models\Event;
use App\Models\Hotel;
use App\Models\Restaurant;
use Livewire\Component;

class AllEvents extends Component
{
    public $date = '';

    public $search = '';

    public $categoryId = '';

    public $ageRestriction = '';

    public $locationSearch = '';

    public $locationResults = [];

    public $selectedLocation = null;

    // TODO: непонятно, зачем нужен этот массив,
    // стоит удалить его, если он ни на что не влияет
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
        if (mb_strlen($this->locationSearch) >= 2) {
            $this->locationResults = collect()
                ->merge(Attraction::where('name', 'like', '%'.$this->locationSearch.'%')->get()->map(function ($item) {
                    $item->type = 'attraction';

                    return $item;
                }))
                ->merge(Hotel::where('name', 'like', '%'.$this->locationSearch.'%')->get()->map(function ($item) {
                    $item->type = 'hotel';

                    return $item;
                }))
                ->merge(Restaurant::where('name', 'like', '%'.$this->locationSearch.'%')->get()->map(function ($item) {
                    $item->type = 'restaurant';

                    return $item;
                }))
                ->merge(CustomLocation::where('name', 'like', '%'.$this->locationSearch.'%')->get()->map(function ($item) {
                    $item->type = 'custom';

                    return $item;
                }));
        } else {
            $this->locationResults = collect();
        }
    }

    // TODO: стоит переделать выбор локации,
    // сделать вместо поля поиска обычный селект,
    // которым проще управлять
    public function selectLocation($value)
    {
        $parts = explode('_', $value);
        $type = $parts[0];
        $id = $parts[1];

        $models = [
            'attraction' => Attraction::class,
            'hotel' => Hotel::class,
            'restaurant' => Restaurant::class,
            'custom' => CustomLocation::class,
        ];

        $location = $models[$type]::find($id);

        if ($location) {
            $this->selectedLocation = $id;
            $this->locationSearch = $location->name;
            $this->locationResults = collect();
        }
    }

    public function render()
    {
        // TODO: необходима оптимизация:
        // стоит вынести тяжелые запросы из render()
        $categories = Category::where('is_active', true)->get();
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
            ->orderBy('start_date')->get();

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
    }
}
