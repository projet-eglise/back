<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Src\Infrastructure\Authentication\Controllers\CreatePasswordRequestController as ControllersCreatePasswordRequestController;

class CreatePasswordRequestController extends Controller
{
    public function __construct(
        ControllersCreatePasswordRequestController $controller
    ) {
        parent::__construct($controller);
    }
}
