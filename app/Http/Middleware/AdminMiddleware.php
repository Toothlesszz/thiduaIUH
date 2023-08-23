<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if(Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            // dd($user);
            if(isset($user->level) && $user->level == '4') {
                return $next($request);
            }
            elseif(isset($user->level) && $user->level == '5'){
              return $next($request);
            }
            else {
              Auth::guard('admin')->logout();
              return redirect()->route('login-admin')->with('error', 'Thông tin tài khoản hoặc mật khẩu không chính xác!');
            }
          }
        else {
          return redirect('/login-admin');
        }
    }
}
