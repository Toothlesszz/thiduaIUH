<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDepartMiddleware
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
        if(Auth::guard('department')->check()) {
            $user = Auth::guard('department')->user();
            if(isset($user->level) && $user->level == '3') {
                return $next($request);
            }
            else {
                Auth::guard('department')->logout();
                return redirect()->route('loginAdminDepartment')->with('error', 'Thông tin tài khoản hoặc mật khẩu không chính xác!');
            }
        } else {
          return redirect('/login-admin-department');
        }
    }
}
