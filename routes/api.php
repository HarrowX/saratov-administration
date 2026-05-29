<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->middleware(['auth:sanctum']);
});

Route::prefix('v1')->controller(ContentController::class)->group(function () {
    Route::get('hotels', 'hotels');
    Route::get('restaurants', 'restaurants');
    Route::get('attractions', 'attractions');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
