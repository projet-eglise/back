<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Src\Infrastructure\Authentication\Controllers\LoginController as ControllersLoginController;

class LoginController extends Controller
{
    public function __construct(
        private ControllersLoginController $loginController
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return Response::json($this->loginController->render($request), 200);
    }
}
