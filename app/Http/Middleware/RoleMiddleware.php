<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Login check
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Role check
        if (Auth::user()->role != $role) {
            abort(403, 'Access Denied');
        }

        return $next($request);
    }
}