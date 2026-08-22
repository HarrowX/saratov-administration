<?php

use App\Http\Controllers\Auth\AuthAppleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\AuthVkController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\FavoritableController;
use App\Http\Controllers\FirebaseDeviceTokenController;
use App\Http\Controllers\PlaceVisitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaratovChatController;
use App\Http\Controllers\v2\ContentV2Controller;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::prefix('auth')
        ->controller(AuthController::class)
        ->group(function () {
            Route::post('login', 'login');
            Route::post('register', 'register');
            Route::post('refresh', 'refresh')->name('token.refresh');
            Route::post('logout', 'logout')->middleware(['auth:sanctum']);

            Route::post('forgot-password', 'forgotPassword');
            Route::post('reset-password', 'changePassword')->middleware(['auth:sanctum']);
            Route::post('post-register', 'postRegister')->middleware(['auth:sanctum']);
        });

    Route::post('auth/vk/token/exchange', [AuthVkController::class, 'exchangeToken']);
    Route::post('auth/apple/token/exchange', [AuthAppleController::class, 'exchangeToken']);

    Route::prefix('firebase')->group(static function () {
        Route::post('fresh-device-token', FirebaseDeviceTokenController::class)->middleware(['auth:sanctum']);
    });

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
            Route::get('events', 'indexEvent');

            Route::post('excursions/{id}', 'favoriteExcursion');
            Route::post('guide-tours/{id}', 'favoriteGuideTour');
            Route::post('events/{id}', 'favoriteEvent');

            Route::delete('excursions/{id}', 'unfavoriteExcursion');
            Route::delete('guide-tours/{id}', 'unfavoriteGuideTour');
            Route::delete('events/{id}', 'unfavoriteEvent');

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

    Route::prefix('ai-chat')
        ->middleware(['auth:sanctum'])
        ->group(function () {
            Route::post('send', [SaratovChatController::class, 'processUserMessage']);
            // TODO: not working
            // Route::post('reset', [SaratovChatController::class, 'resetDialog']);
            Route::get('messages', [SaratovChatController::class, 'getAllMessages']);
        });
    Route::post('contact-us/send', [ContactUsController::class, 'store'])
        ->middleware(['auth:sanctum']);
});

Route::prefix('v2')->group(function () {
    Route::controller(ContentV2Controller::class)
        ->middleware(['auth:sanctum'])
        ->group(function () {
            Route::prefix('places')->group(function () {
                Route::get('hotels', 'listHotels');

                Route::get('restaurants', 'listRestaurants');

                Route::get('attractions', 'listAttractions');
            });

            Route::get('excursions', 'listExcursions');

            Route::get('events', 'listEvents');
        });
});
