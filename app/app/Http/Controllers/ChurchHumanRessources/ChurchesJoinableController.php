<?php

namespace App\Http\Controllers\ChurchHumanRessources;

use App\Http\Controllers\Controller;
use Src\Infrastructure\ChurchHumanRessources\Controllers\ChurchesJoinableController as ControllersChurchesJoinableController;

class ChurchesJoinableController extends Controller
{
    public function __construct(
        ControllersChurchesJoinableController $controller
    ) {
        parent::__construct($controller);
    }
}
