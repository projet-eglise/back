<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Src\Infrastructure\Authentication\Controllers\AdminLoginController as ControllersAdminLoginController;

class AdminLoginController extends Controller
{
    public function __construct(
        ControllersAdminLoginController $controller
    ) {
        parent::__construct($controller);
    }
}
