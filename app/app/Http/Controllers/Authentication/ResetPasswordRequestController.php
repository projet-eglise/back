<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Src\Infrastructure\Authentication\Controllers\ResetPasswordRequestController as ControllersResetPasswordRequestController;

class ResetPasswordRequestController extends Controller
{
    public function __construct(
        ControllersResetPasswordRequestController $controller
    ) {
        parent::__construct($controller);
    }
}
