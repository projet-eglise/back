<?php

namespace App\Http\Middleware;

use Closure;
use Src\Domain\Authentication\Exceptions\NotUserException;
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
        $token = new JwtToken(str_replace('Bearer ', '', $request->header('Authorization')));

        if (!$token->hasField('isAdmin') || $token->hasAFieldThatIs('isAdmin', true))
            throw new NotUserException();

        return $next($request);
    }
}
