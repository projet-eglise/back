<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyNamespace\MyControllerNameController;

/*
|--------------------------------------------------------------------------
| MyNamespace module
|--------------------------------------------------------------------------
|
| Lorem ipsum dolor sit amet consectetur.
|
*/

Route::get('change', MyControllerNameController::class);
