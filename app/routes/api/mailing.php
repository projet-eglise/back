<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mailing\AllController;
use App\Http\Controllers\Mailing\AllForUserController;

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
    Route::get('all-for-user', AllForUserController::class)
        ->where('email', '([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})');
});
