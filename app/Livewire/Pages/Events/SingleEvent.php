<?php

namespace App\Livewire\Pages\Events;

use App\Models\Event;
use App\Services\FavoritableService;
use App\Services\ViewService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SingleEvent extends Component
{
    public $event;

    public int $favoritesCount = 0;

    public $isFavorite = false;

    protected FavoritableService $favoritableService;

    protected ViewService $viewService;

    public function boot(FavoritableService $favoritableService, ViewService $viewService): void
    {
        $this->favoritableService = $favoritableService;
        $this->viewService = $viewService;
    }

    public function mount(Event $event)
    {
        $this->event = $event;
        $this->event->load('categories', 'attachments', 'eventable');

        $this->favoritesCount = $event?->favorites?->count() ?? 0;

        if (Auth::check()) {
            $this->isFavorite = $event?->favorites?->contains('user_id', auth()->id());
        }

        $this->viewService->calculate($this->event->id, Event::class);
    }

    public function render()
    {
        return view('livewire.pages.events.single-event');
    }

    public function toggleFavorite()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if ($this->isFavorite) {
            $this->unfavorite();
        } else {
            $this->favorite();
        }
    }

    public function favorite()
    {
        $this->favoritableService->save(
            auth()->user()->id,
            $this->event->id,
            Event::class
        );

        $this->isFavorite = true;
        $this->favoritesCount++;
    }

    public function unfavorite()
    {
        $this->favoritableService->delete(
            auth()->user()->id,
            $this->event->id,
            Event::class
        );

        $this->isFavorite = false;
        $this->favoritesCount--;
    }
}
