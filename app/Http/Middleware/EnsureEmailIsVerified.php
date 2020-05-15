<?php

namespace App\Http\Middleware;

use Closure;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user() && !$request->user()->hasVerifiedEmail() && !$request->is('email/*', 'logout'))
        {
            $isJson = $request->expectsJson();
            if($isJson)
            {
                return abort(403, 'You email address is not verified. ');
            }
            else
            {
                return redirect()->route('verification.notice');
            }
        }
        return $next($request);
    }
}
