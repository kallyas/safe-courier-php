<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!$request->user()->hasRole($role)) {
            // send unauthorized response
            return response('Unauthorized.', 401);
        }
        return $next($request);
    }
}
