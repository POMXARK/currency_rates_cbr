<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Проверка межсервисной авторизации по статично заданному токену аутентификации.
 */
class AuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($requestToken = $request->header('Authorization')) {
            foreach (config('project.auth.tokens') as $token) {
                if ($requestToken === $token) {
                    return $next($request);
                }
            }
        }

        abort(Response::HTTP_UNAUTHORIZED);
    }
}
