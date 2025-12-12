<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganizerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('organizers', OrganizerController::class);
Route::resource('events', EventController::class);

//Route::resource('organizers', \App\Repositories\Organizer\OrganizerRepository::class);
//Route::resource('events', \App\Repositories\Event\EventRepository::class);

