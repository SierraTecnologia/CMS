<?php

namespace SierraTecnologia\Cms\Middleware;

use Closure;
use SierraTecnologia\Cms\Services\AnalyticsService;

class SierraTecnologiaCmsAnalytics
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->ajax()) {
            app(AnalyticsService::class)->log($request);
        }

        return $next($request);
    }
}
