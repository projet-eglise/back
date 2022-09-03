<?php

namespace App\Http\Controllers\ChurchHumanRessources;

use App\Http\Controllers\Controller;
use Src\Infrastructure\ChurchHumanRessources\Controllers\AllChristiansController as ControllersAllChristiansController;

class AllChristiansController extends Controller
{
    public function __construct(
        ControllersAllChristiansController $controller
    ) {
        parent::__construct($controller);
    }
}
