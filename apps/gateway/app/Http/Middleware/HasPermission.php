<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class HasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $permission
     * @return mixed
     */
    public function handle($request, Closure $next, string $permission)
    {
        if (!Auth::check()) {
            abort(401);
        }

        if (!optional(Auth::hasPermission($permission))) {
            abort(403);
        }


        return $next($request);
    }
}
