<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Src\Infrastructure\Shared\Interfaces\Controller as DomainController;

class Controller extends RoutingController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(
        protected DomainController $controller,
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
        return Response::json([
            'code' => 200,
            'message' => 'OK',
            'data' => $this->controller->render($request) ?? [],
        ], 200);
    }
}
