<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\AdminLoginController;

/*
|--------------------------------------------------------------------------
| Authentication module
|--------------------------------------------------------------------------
|
| This module allows you to manage the users of the application.
|
*/
Route::post('authentication/login', LoginController::class);
Route::post('admin/authentication/login', AdminLoginController::class);