<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits\ActivityLogger;

class LogActivityMiddleware
{
    use ActivityLogger;

    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        // Bisa mencatat akses ke halaman, tapi hati-hati terlalu banyak
        // if (in_array($request->method(), ['GET']) && !in_array($request->route()->getName(), ['admin.activity-log.index'])) {
        //     $this->logActivity('view', $request->route()->getName() ?: 'unknown', null, null, null);
        // }
    }
}