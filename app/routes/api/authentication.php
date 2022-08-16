<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\AdminLoginController;
use App\Http\Controllers\Authentication\ResetPasswordRequestController;

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
Route::get('reset-password/{email}', ResetPasswordRequestController::class)
    ->where('email', '([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})');

Route::middleware(['auth'])->group(function () {
});
