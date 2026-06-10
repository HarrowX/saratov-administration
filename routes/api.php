<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\FavoritableController;
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

    Route::prefix('users')->group(function () {


        Route::middleware(['auth:sanctum'])->controller(ProfileController::class)
            ->group(function () {
                Route::get('me', 'show');
                Route::put('me', 'update');
            });
    });

    Route::prefix('places')->group(function () {
        Route::controller(ContentController::class)->group(function () {
            Route::get('hotels', 'hotels');
            Route::get('restaurants', 'restaurants');
            Route::get('attractions', 'attractions');
        });
    });

    Route::prefix('favorites/places')
        ->controller(FavoritableController::class)
        ->middleware(['auth:sanctum'])
        ->group(function () {
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
});
