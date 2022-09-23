<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\AdminLoginController;
use App\Http\Controllers\Authentication\AllPasswordRequestsController;
use App\Http\Controllers\Authentication\BecomeAGhostController;
use App\Http\Controllers\Authentication\CheckPasswordRequestController;
use App\Http\Controllers\Authentication\CreatePasswordRequestController;
use App\Http\Controllers\Authentication\ChangePasswordController;
use App\Http\Controllers\Authentication\SigninController;

/*
|--------------------------------------------------------------------------
| Authentication module
|--------------------------------------------------------------------------
|
| This module allows you to manage the users of the application.
|
*/

Route::post('login', LoginController::class);

Route::post('admin/login', AdminLoginController::class);

Route::get('reset-password/{email}', CreatePasswordRequestController::class)
    ->where('email', '([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})');

Route::get('check-password-request/{token}', CheckPasswordRequestController::class)
    ->where('token', '^[a-z0-9]*$');

Route::post('change-password/{token}', ChangePasswordController::class)
    ->where('token', '^[a-z0-9]*$');

Route::post('signin', SigninController::class);

Route::middleware(['auth.admin'])->group(function () {
    Route::get('become-a-ghost/{email}', BecomeAGhostController::class)
        ->where('email', '([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})');

    Route::get('password-requests/{email}', AllPasswordRequestsController::class)
        ->where('email', '([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})');
});
