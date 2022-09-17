<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use Src\Infrastructure\Logs\Controllers\AllRequestsController as ControllersAllRequestsController;

class AllRequestsController extends Controller
{
    public function __construct(
        ControllersAllRequestsController $controller
    ) {
        parent::__construct($controller);
    }
}
