<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckManager
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Check if user has manager role
        if (!auth()->user()->isManager()) { // or your role check logic
            abort(403, 'Manager access required');
        }

        return $next($request);
    }
}
