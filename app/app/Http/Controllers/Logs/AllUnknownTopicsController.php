<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use Src\Infrastructure\Logs\Controllers\AllUnknownTopicsController as ControllersAllUnknownTopicsController;

class AllUnknownTopicsController extends Controller
{
    public function __construct(
        ControllersAllUnknownTopicsController $controller
    ) {
        parent::__construct($controller);
    }
}
