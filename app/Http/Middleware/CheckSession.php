<?php

namespace App\Http\Middleware;

use Closure;

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('user')) {
            // Store the current URL in the session
            return redirect()->route('a')->withErrors('Silahkan Login Terlebih Dahulu');
        }
        return $next($request);
    }
}
