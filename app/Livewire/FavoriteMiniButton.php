<?php

namespace App\Livewire;

use App\Services\FavoritableService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FavoriteMiniButton extends Component
{
    public $isFavorite = false;
    public $favoritesCount;
    public $object;
    public $position = 'top-7 right-6.5 sm:top-10 sm:right-9.5';

    private $favoritableService;

    public function boot(FavoritableService $favoritableService): void
    {
        $this->favoritableService = $favoritableService;
    }

    public function mount()
    {
        $this->favoritesCount = $this->object?->favorites?->count() ?? 0;
        if (Auth::check()) {
            $this->isFavorite = $this->object?->favorites?->contains('user_id', auth()->id());
        }
    }

    public function render()
    {
        return view('livewire.favorite-mini-button');
    }

    public function toggleFavorite()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $class = get_class($this->object);

        try {
            if ($this->isFavorite) {
                $this->unfavorite($class);
            } else {
                $this->favorite($class);
            }
        } catch (\Exception $e) {
            // Логируем ошибку
            \Log::error('Favorite toggle error: ' . $e->getMessage());
        }
    }

    public function favorite($class)
    {
        $this->favoritableService->save(
            auth()->user()->id,
            $this->object->id,
            $class
        );

        $this->isFavorite = true;
        $this->favoritesCount++;
    }

    public function unfavorite($class)
    {
        $this->favoritableService->delete(
            auth()->user()->id,
            $this->object->id,
            $class,
        );

        $this->isFavorite = false;
        $this->favoritesCount--;
    }
}
