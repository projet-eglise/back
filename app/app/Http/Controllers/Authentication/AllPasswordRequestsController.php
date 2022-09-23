<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Src\Infrastructure\Authentication\Controllers\AllPasswordRequestsController as ControllersAllPasswordRequestsController;

class AllPasswordRequestsController extends Controller
{
    public function __construct(
        ControllersAllPasswordRequestsController $controller
    ) {
        parent::__construct($controller);
    }
}
