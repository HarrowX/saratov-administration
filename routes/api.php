<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->controller(AuthController::class)
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

    Route::prefix('places')->controller(ContentController::class)
        ->group(function () {
            Route::get('hotels', 'hotels');
            Route::get('restaurants', 'restaurants');
            Route::get('attractions', 'attractions');
        });
});
