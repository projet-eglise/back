<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use Src\Infrastructure\Logs\Controllers\SeenTopicController as ControllersSeenTopicController;

class SeenTopicController extends Controller
{
    public function __construct(
        ControllersSeenTopicController $controller
    ) {
        parent::__construct($controller);
    }
}
