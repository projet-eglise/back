<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Src\Infrastructure\Authentication\Controllers\LoginController as ControllersLoginController;

class LoginController extends Controller
{
    public function __construct(
        ControllersLoginController $controller
    ) {
        parent::__construct($controller);
    }
}
