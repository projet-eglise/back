<?php

namespace App\Http\Controllers\Mailing;

use App\Http\Controllers\Controller;
use Src\Infrastructure\Mailing\Controllers\AllForUserController as ControllersAllForUserController;

class AllForUserController extends Controller
{
    public function __construct(
        ControllersAllForUserController $controller
    ) {
        parent::__construct($controller);
    }
}
