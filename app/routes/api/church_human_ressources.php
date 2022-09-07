<?php

use App\Http\Controllers\ChurchHumanRessources\AllChristiansController;
use App\Http\Controllers\ChurchHumanRessources\AllChurchesController;
use App\Http\Controllers\ChurchHumanRessources\ChurchesJoinableController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Church Human Ressources module
|--------------------------------------------------------------------------
|
| This module allows you to manage church members and their roles.
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('churches/joinable', ChurchesJoinableController::class);
});

Route::middleware(['auth.admin'])->group(function () {
    Route::get('christians/all', AllChristiansController::class);
    Route::get('churches/all', AllChurchesController::class);
});