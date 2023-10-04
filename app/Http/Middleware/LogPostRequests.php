<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogPostRequests
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

      /*   if ($request->is('api/*') && $request->isMethod('post')) {
            // Log the POST request data
            \Log::info('API POST request data: ' . json_encode($request->all()));
        }
 */

        if ($request->isMethod('post')) {
            // Log the POST request data
            \Log::info('POST request data: ' . json_encode($request->all()));
        }

        return $next($request);
    }
}
