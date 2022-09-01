<?php

use App\Http\Controllers\Mailing\AllController;
use App\Http\Controllers\Mailing\LastController;
use App\Http\Controllers\Mailing\LastForUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Mailing module
|--------------------------------------------------------------------------
|
| Module used to send emails to users.
|
*/

Route::middleware(['auth.admin'])->group(function () {
    Route::get('all', AllController::class);
    // Route::get('last', LastController::class);
    // Route::get('last/{email}', LastForUserController::class)
    //     ->where('email', '([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})');
});
