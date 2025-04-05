<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApiAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('sanctum')->check()) {
            Log::warning('Unauthorized access attempt', [
                'headers' => $request->headers->all(),
                'token' => $request->bearerToken(),
            ]);
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Attach the authenticated user to the request
        $request->setUserResolver(function () {
            return Auth::guard('sanctum')->user();
        });

        return $next($request);
    }
}
