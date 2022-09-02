<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Src\Infrastructure\Authentication\Controllers\SigninController as ControllersSigninController;

class SigninController extends Controller
{
    public function __construct(
        ControllersSigninController $controller
    ) {
        parent::__construct($controller);
    }
}
