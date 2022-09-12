<?php

namespace App\Http\Controllers\ChurchHumanRessources;

use App\Http\Controllers\Controller;
use Src\Infrastructure\ChurchHumanRessources\Controllers\AllServicesController as ControllersAllServicesController;

class AllServicesController extends Controller
{
    public function __construct(
        ControllersAllServicesController $controller
    ) {
        parent::__construct($controller);
    }
}
