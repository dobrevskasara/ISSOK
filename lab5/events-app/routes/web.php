<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('organizers', \App\Http\Controllers\OrganizerController::class);
Route::resource('events', \App\Http\Controllers\EventController::class);

