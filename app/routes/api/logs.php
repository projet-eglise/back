<?php

use App\Http\Controllers\Logs\AllRequestsController;
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
});
