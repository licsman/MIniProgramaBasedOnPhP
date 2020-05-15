<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
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
//        session(['user'=>null]);
        if (!session('user')){
            return redirect('admin/login')->with('msg','请先登录！');
        }
        return $next($request);
    }
}