<?php

namespace App\Http\Middleware;

use App\Enums\AccountHome;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                //Quy định khi người dùng đã đăng nhập thì
                // sẽ điều hướng về trang của họ
                // ví dụ: admin, user, ...
                $role = Auth::user()->role;
                switch ($role) {
//                    case AccountHome::ADMIN_HOME:
//                        return redirect()->route('admin.home');
                    case AccountHome::USER_HOME:
                        return redirect()->route('user.profile.info');
                    default:
                        return redirect()->route('login');
                }
            }
        }

        return $next($request);
    }
}
