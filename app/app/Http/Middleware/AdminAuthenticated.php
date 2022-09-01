<?php

namespace App\Http\Middleware;

use Closure;
use Src\Domain\Authentication\Exceptions\NotAdminException;
use Src\Domain\Authentication\JwtToken;

class AdminAuthenticated
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
        $token = new JwtToken(str_replace('Bearer ', '', $request->header('Authorization')));

        if (!$token->hasField('isAdmin') || $token->hasAFieldThatIs('isAdmin', false))
            throw new NotAdminException('You are trying to access an administrator resource.');

        return $next($request);
    }
}
