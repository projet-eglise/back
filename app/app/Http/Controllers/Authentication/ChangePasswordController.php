<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Src\Infrastructure\Authentication\Controllers\ChangePasswordController as ControllersChangePasswordController;

class ChangePasswordController extends Controller
{
    public function __construct(
        ControllersChangePasswordController $controller
    ) {
        parent::__construct($controller);
    }
}
