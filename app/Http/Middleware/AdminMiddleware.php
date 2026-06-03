<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Unauthorized access'
            ], 401);
        }

        $userRole = strtolower(Auth::user()->role->name);

        // If no roles specified, default to Admin only
        if (empty($roles)) {
            $roles = ['admin'];
        }

        foreach ($roles as $role) {
            // Check matches (be flexible for 'user' / 'customer' references)
            if ($userRole === strtolower($role) || ($role === 'user' && $userRole === 'customer') || ($role === 'customer' && $userRole === 'user')) {
                return $next($request);
            }
        }

        return response()->json([
            'message' => 'Unauthorized access. Access restricted to roles: ' . implode(', ', $roles)
        ], 403);
    }
}
