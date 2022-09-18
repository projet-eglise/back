<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use Src\Infrastructure\Logs\Controllers\AllRequestsForUserController as ControllersAllRequestsForUserController;

class AllRequestsForUserController extends Controller
{
    public function __construct(
        ControllersAllRequestsForUserController $controller
    ) {
        parent::__construct($controller);
    }
}
