<?php

use App\Livewire\Index;
use App\Livewire\Pages\Attractions\AllAttractions;
use App\Livewire\Pages\Attractions\SingleAttraction;
use App\Livewire\Pages\Excurtions\AllExcurtions;
use App\Livewire\Pages\Excurtions\SingleExcurtion;
use App\Livewire\Pages\GuidedTours\AllGuidedTours;
use App\Livewire\Pages\GuidedTours\SingleGuidedTour;
use App\Livewire\Pages\Hotels\AllHotels;
use App\Livewire\Pages\Hotels\SingleHotel;
use App\Livewire\Pages\Places\AllPlaces;
use App\Livewire\Pages\Places\SinglePlace;
use Illuminate\Support\Facades\Route;


Route::get('/', Index::class)->name('index');

Route::prefix('/excurtions')->group(function () {
    Route::get('/', AllExcurtions::class)->name('all-excurtions');
    Route::get('/{excurtion}', SingleExcurtion::class)->name('single-excurtion');
});

Route::prefix('/guided-tours')->group(function () {
    Route::get('/', AllGuidedTours::class)->name('all-guided-tours');
    Route::get('/{guidedTour}', SingleGuidedTour::class)->name('single-guided-tour');
});

Route::prefix('/places')->group(function () {
    Route::get('/', AllPlaces::class)->name('all-places');
    Route::get('/{place}', SinglePlace::class)->name('single-place');
});

Route::prefix('/attractions')->group(function () {
    Route::get('/', AllAttractions::class)->name('all-attractions');
    Route::get('/{attraction}', SingleAttraction::class)->name('single-attraction');
});

Route::prefix('/hotels')->group(function () {
    Route::get('/', AllHotels::class)->name('all-hotels');
    Route::get('/{hotel}', SingleHotel::class)->name('single-hotel');
});



