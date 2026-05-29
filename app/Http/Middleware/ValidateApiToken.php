<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateApiToken
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('X-API-Token') !== config('app.api_token')) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Unauthorized.',
            ], 401);
        }

        return $next($request);
    }
}
