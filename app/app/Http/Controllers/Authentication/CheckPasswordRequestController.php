<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Src\Infrastructure\Authentication\Controllers\CheckPasswordRequestController as ControllersCheckPasswordRequestController;

class CheckPasswordRequestController extends Controller
{
    public function __construct(
        ControllersCheckPasswordRequestController $controller
    ) {
        parent::__construct($controller);
    }
}
