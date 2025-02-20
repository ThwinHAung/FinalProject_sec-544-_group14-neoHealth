<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('admin') || 
        $request->session()->has('patient') || 
        $request->session()->has('doctor')) {
        return $next($request);
    }

    return redirect()->route('login')->with('error', 'Please login to access this page.');
    }
}
