<?php

namespace App\Http\Middleware;

use Closure;
use Src\Domain\Authentication\JwtToken;

class Authenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // I create a JwtToken to raise an error if the token is invalid
        new JwtToken(str_replace('Bearer ', '', $request->header('Authorization')));
        return $next($request);
    }
}
