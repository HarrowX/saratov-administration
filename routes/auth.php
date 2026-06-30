<?php

use App\Http\Controllers\Auth\AuthVkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('register', 'pages.auth.register')
        ->name('register');

    Volt::route('login', 'pages.auth.login')
        ->name('login');

    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');
});

Route::controller(AuthVkController::class)->group(function () {
    Route::post('/auth/vk/callback', 'handleProviderCallback')->name('vk.callback');

    Route::middleware(['auth'])->prefix('profile')->group(function () {
        Route::get('/connect/vk', 'redirectToConnect')->name('profile.connect.vk');
        Route::get('/connect/vk/callback', 'handleConnectCallback')->name('profile.connect.vk.callback');
        Route::delete('/disconnect/vk', 'disconnect')->name('profile.disconnect.vk');
    });
});
