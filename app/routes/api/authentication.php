<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\AdminLoginController;
use App\Http\Controllers\Authentication\CheckPasswordRequestController;
use App\Http\Controllers\Authentication\CreatePasswordRequestController;

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

Route::middleware(['auth'])->group(function () {
});
