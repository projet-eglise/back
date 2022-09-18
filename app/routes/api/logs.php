<?php

use App\Http\Controllers\Logs\AllRequestsController;
use App\Http\Controllers\Logs\AllRequestsForUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Logs module
|--------------------------------------------------------------------------
|
| Module to keep track of the user's actions and errors.
|
*/

Route::middleware(['auth.admin'])->group(function () {
    Route::get('requests', AllRequestsController::class);
    Route::get('requests-for-user/{uuid}', AllRequestsForUserController::class);
});
