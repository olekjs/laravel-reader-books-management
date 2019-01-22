<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        $userRole = $request->user()->role;

        if ($userRole != 1 && $userRole != 2) {
            return redirect('/');
        }

        return $next($request);
    }
}
