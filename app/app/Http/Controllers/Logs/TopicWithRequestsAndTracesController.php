<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use Src\Infrastructure\Logs\Controllers\TopicWithRequestsAndTracesController as ControllersTopicWithRequestsAndTracesController;

class TopicWithRequestsAndTracesController extends Controller
{
    public function __construct(
        ControllersTopicWithRequestsAndTracesController $controller
    ) {
        parent::__construct($controller);
    }
}
