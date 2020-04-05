<?php

namespace Salem\Tracker\Controls\Http\Middleware;

use Closure;
use Tracker;

class VisitorTrack
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
        try {
            Tracker::track($request->ip());
        } catch (Exception $e) {
            // do nothing
        }
        return $next($request);
    }
} 