<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::prefix('content')->group(function () {
    Route::get('hotels', [ContentController::class, 'hotels']);
    Route::get('restaurants', [ContentController::class, 'restaurants']);
    Route::get('attractions', [ContentController::class, 'attractions']);
    Route::get('excursions', [ContentController::class, 'excursions']);

});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
