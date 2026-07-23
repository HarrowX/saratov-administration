<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\AuthVkController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\FavoritableController;
use App\Http\Controllers\PlaceVisitController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::prefix('auth')
        ->controller(AuthController::class)
        ->group(function () {
            Route::post('login', 'login');
            Route::post('register', 'register');
            Route::post('logout', 'logout')->middleware(['auth:sanctum']);
        });

    Route::post('auth/vk/token/exchange', [AuthVkController::class, 'exchangeToken']);

    Route::prefix('users')->group(function () {
        Route::middleware(['auth:sanctum'])
            ->controller(ProfileController::class)
            ->group(function () {
                Route::get('me', 'show');
                Route::put('me', 'update');
            });
    });

    Route::controller(ContentController::class)
        ->middleware(['auth:sanctum'])
        ->group(function () {
            Route::prefix('places')->group(function () {
                Route::get('hotels', 'hotels');
                Route::get('hotels/{id}', 'hotel');

                Route::get('restaurants', 'restaurants');
                Route::get('restaurants/{id}', 'restaurant');

                Route::get('attractions', 'attractions');
                Route::get('attractions/{id}', 'attraction');
            });

            Route::get('excursions', 'excursions');
            Route::get('excursions/{id}', 'excursion');

            Route::get('guide-tours', 'guideTours');
            Route::get('guide-tours/{id}', 'guideTour');

            Route::get('events', 'events');
            Route::get('events/{id}', 'event');
        });


    Route::prefix('favorites')
        ->controller(FavoritableController::class)
        ->middleware(['auth:sanctum'])
        ->group(function () {
            Route::get('', 'index');
            Route::prefix('places')->group(function () {
                Route::get('hotels', 'indexHotel');
                Route::get('restaurants', 'indexRestaurant');
                Route::get('attractions', 'indexAttraction');

                Route::post('hotels/{id}', 'favoriteHotel');
                Route::post('restaurants/{id}', 'favoriteRestaurant');
                Route::post('attractions/{id}', 'favoriteAttraction');

                Route::delete('hotels/{id}', 'unfavoriteHotel');
                Route::delete('restaurants/{id}', 'unfavoriteRestaurant');
                Route::delete('attractions/{id}', 'unfavoriteAttraction');
            });

            Route::get('excursions', 'indexExcursion');
            Route::get('guide-tours', 'indexGuideTour');

            Route::post('excursions/{id}', 'favoriteExcursion');
            Route::post('guide-tours/{id}', 'favoriteGuideTour');

            Route::delete('excursions/{id}', 'unfavoriteExcursion');
            Route::delete('guide-tours/{id}', 'unfavoriteGuideTour');

        });

    Route::prefix('visits')
        ->controller(PlaceVisitController::class)
        ->middleware(['auth:sanctum'])
        ->group(function () {
            Route::get('recently', 'findRecentlyVisits');
            Route::post('around', 'around');
            Route::patch('approve', 'approve');
            Route::patch('disapprove', 'disapprove');
        });
});
