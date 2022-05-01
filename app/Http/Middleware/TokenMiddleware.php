<?php

namespace App\Http\Middleware;

use App\HttpRequest;
use Closure;
use Illuminate\Http\Request;

class TokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (session()->get('api_token')){

            $http = HttpRequest::makeRequest('/auth/refresh', 'post');

            if ($http->status() == 200) {

                session(['api_token' => $http->object()->access_token]);

                return $next($request);
            }

            return redirect()->route('logout');
        }

        return redirect()->route('login');

    }
}
