<?php

namespace App\Http\Controllers\ChurchHumanRessources;

use App\Http\Controllers\Controller;
use Src\Infrastructure\ChurchHumanRessources\Controllers\AllChurchesController as ControllersAllChurchesController;

class AllChurchesController extends Controller
{
    public function __construct(
        ControllersAllChurchesController $controller
    ) {
        parent::__construct($controller);
    }
}
