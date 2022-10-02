<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use Src\Infrastructure\Logs\Controllers\AllKnownTopicsController as ControllersAllKnownTopicsController;

class AllKnownTopicsController extends Controller
{
    public function __construct(
        ControllersAllKnownTopicsController $controller
    ) {
        parent::__construct($controller);
    }
}
