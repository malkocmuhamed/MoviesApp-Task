<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    public function handle($request, Closure $next, $role)
    {
        return $next($request);
    }
}
