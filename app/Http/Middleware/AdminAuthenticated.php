<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->routeIs('admin.auth.login') || $request->routeIs('admin.auth.logout')) {
            return dd('12');
        } 
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }
        return redirect()->route('admin.auth.login');
    }
}
