<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Src\Infrastructure\Authentication\Controllers\BecomeAGhostController as ControllersBecomeAGhostController;

class BecomeAGhostController extends Controller
{
    public function __construct(
        ControllersBecomeAGhostController $controller
    ) {
        parent::__construct($controller);
    }
}
