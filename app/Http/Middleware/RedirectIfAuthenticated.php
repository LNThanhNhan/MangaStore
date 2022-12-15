<?php

namespace App\Http\Middleware;

use App\Enums\AccountHome;
use App\Enums\AccountRole;
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
                    case AccountRole::ADMIN:
                        return redirect(AccountHome::ADMIN_HOME);
                    case AccountRole::USER:
                        return redirect(AccountHome::USER_HOME);
                    default:
                        return redirect()->route('login');
                }
            }
        }

        return $next($request);
    }
}
