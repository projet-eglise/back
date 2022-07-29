<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\LoginController;

/*
|--------------------------------------------------------------------------
| Authentication module
|--------------------------------------------------------------------------
|
| This module allows you to manage the users of the application.
|
*/
Route::post('authentication/login', LoginController::class);