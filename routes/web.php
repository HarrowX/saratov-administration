<?php

use Illuminate\Support\Facades\Route;

Route::group(['layout' => 'components.layouts.app'], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

