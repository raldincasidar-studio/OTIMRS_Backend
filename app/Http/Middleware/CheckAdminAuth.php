<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Session;

class CheckAdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check if request header has token
        if (! $request->hasHeader('Authorization')) {
            return response()->json([
                'error' => 'Authorization ID empty',
                'logout' => 1,
            ], 200);
        }

        // check if authorization header is in the sessions table in database
        $isValid = Session::where('id', $request->header('Authorization'))->first();

        if (! $isValid) {
            return response()->json([
                'error' => 'Authorization failed',
                'logout' => 1,
            ], 200);
        }

        return $next($request);
    }
}
