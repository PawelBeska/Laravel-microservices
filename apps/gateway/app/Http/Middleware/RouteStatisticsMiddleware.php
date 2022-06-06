<?php

namespace App\Http\Middleware;

use App\Services\RouteStatisticsService;
use Closure;
use Exception;
use Illuminate\Http\Request;

class RouteStatisticsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            (new RouteStatisticsService())->findOrNew($request);
        } catch (Exception $e) {
            reportError($e);
        }

        return $next($request);
    }
}
