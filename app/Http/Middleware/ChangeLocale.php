<?php

/*
 * @author weifan
 * Wednesday 1st of April 2020 11:14:51 AM
 */

namespace App\Http\Middleware;

use Closure;

class ChangeLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $language = $request->header('accept-language');

        if ($language) {
            \App::setLocale($language);
        }

        return $next($request);
    }
}
