<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetUserController;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\DeleteUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('user/{id}', GetUserController::class);
Route::post('user', CreateUserController::class);
Route::put('user/{id}', UpdateUserController::class);
Route::delete('user/{id}', DeleteUserController::class);
