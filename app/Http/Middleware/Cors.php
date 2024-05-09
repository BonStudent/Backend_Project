<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);

        // Apply CORS headers for other routes

         // Apply CORS headers for all routes
         $response->header('Access-Control-Allow-Origin', '*');
         $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
         $response->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
         $response->header('Access-Control-Allow-Credentials', 'true'); // Allow credentials
        return $response;
    }
}