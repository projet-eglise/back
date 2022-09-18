<?php

namespace App\Http\Controllers\ChurchHumanRessources;

use App\Http\Controllers\Controller;
use Src\Infrastructure\ChurchHumanRessources\Controllers\GetChristianController as ControllersGetChristianController;

class GetChristianController extends Controller
{
    public function __construct(
        ControllersGetChristianController $controller
    ) {
        parent::__construct($controller);
    }
}
