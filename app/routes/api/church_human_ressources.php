<?php

use App\Http\Controllers\ChurchHumanRessources\AllChristiansController;
use App\Http\Controllers\ChurchHumanRessources\AllChurchesController;
use App\Http\Controllers\ChurchHumanRessources\AllServicesController;
use App\Http\Controllers\ChurchHumanRessources\ChurchesJoinableController;
use App\Http\Controllers\ChurchHumanRessources\GetChristianController;
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
    Route::get('services-with-roles-and-options', AllServicesController::class);
});

Route::middleware(['auth.admin'])->group(function () {
    Route::get('christians/all', AllChristiansController::class);
    Route::get('christian/{uuid}', GetChristianController::class);
    Route::get('churches/all', AllChurchesController::class);
});
