<?php

namespace App\Http\Controllers\Mailing;

use App\Http\Controllers\Controller;
use Src\Infrastructure\Mailing\Controllers\AllController as ControllersAllController;

class AllController extends Controller
{
    public function __construct(
        ControllersAllController $controller
    ) {
        parent::__construct($controller);
    }
}
