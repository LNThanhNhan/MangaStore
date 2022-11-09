<?php

namespace App\Http\Middleware;

use App\Enums\AccountRole;
use Closure;
use Illuminate\Http\Request;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //check if user role is user then go to next middleware else abort with 403
        if (auth()->user()->role === AccountRole::USER ) {
            return $next($request);
        }
        abort(403);
    }
}
