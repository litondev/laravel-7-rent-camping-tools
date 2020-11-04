<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class isLogin
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
        // APAKAH SUDAH LOGIN
        if(!Auth::user()){
            return redirect("/signin");
        }
                
        return $next($request);
    }
}
