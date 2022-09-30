<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use Src\Infrastructure\Logs\Controllers\UnseenTopicController as ControllersUnseenTopicController;

class UnseenTopicController extends Controller
{
    public function __construct(
        ControllersUnseenTopicController $controller
    ) {
        parent::__construct($controller);
    }
}
