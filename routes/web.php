<?php

use App\Livewire\Index;
use App\Livewire\Pages\Attractions\AllAttractions;
use App\Livewire\Pages\Attractions\SingleAttraction;
use App\Livewire\Pages\Events\AllEvents;
use App\Livewire\Pages\Events\SingleEvent;
use App\Livewire\Pages\Excursions\AllExcursions;
use App\Livewire\Pages\Excursions\SingleExcursion;
use App\Livewire\Pages\GuidedTours\AllGuidedTours;
use App\Livewire\Pages\GuidedTours\SingleGuidedTour;
use App\Livewire\Pages\Hotels\AllHotels;
use App\Livewire\Pages\Hotels\SingleHotel;
use App\Livewire\Pages\Restaurants\AllRestaurants;
use App\Livewire\Pages\Restaurants\SingleRestaurant;
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('index');

Route::prefix('/excursions')->group(function () {
    Route::get('/', AllExcursions::class)->name('all-excursions');
    Route::get('/{excursion}', SingleExcursion::class)->name('single-excursion');
});

Route::prefix('/guided-tours')->group(function () {
    Route::get('/', AllGuidedTours::class)->name('all-guided-tours');
    Route::get('/{guidedTour}', SingleGuidedTour::class)->name('single-guided-tour');
});

Route::prefix('/restaurants')->group(function () {
    Route::get('/', AllRestaurants::class)->name('all-restaurants');
    Route::get('/{restaurant}', SingleRestaurant::class)->name('single-restaurant');
});

Route::prefix('/attractions')->group(function () {
    Route::get('/', AllAttractions::class)->name('all-attractions');
    Route::get('/{attraction}', SingleAttraction::class)->name('single-attraction');
});

Route::prefix('/hotels')->group(function () {
    Route::get('/', AllHotels::class)->name('all-hotels');
    Route::get('/{hotel}', SingleHotel::class)->name('single-hotel');
});

Route::prefix('/events')->group(function () {
    Route::get('/', AllEvents::class)->name('all-events');
    Route::get('/{event}', SingleEvent::class)->name('single-event');
});

// Route::view('/', 'welcome');
Route::view('profile', 'profile')
    ->middleware(['auth', 'verified'])
    ->name('profile');

Route::view('profile/settings', 'profile-settings')
    ->middleware(['auth'])
    ->name('profile-settings');

Route::view('profile/favorites', 'favorites')
    ->middleware(['auth', 'verified'])
    ->name('profile-favorites');

Route::view('profile/place-visits', 'place-visits')
    ->middleware(['auth', 'verified'])
    ->name('place-visits');

Route::view('profile/history-views', 'history-views')
    ->middleware(['auth', 'verified'])
    ->name('history-views');

require __DIR__.'/auth.php';
