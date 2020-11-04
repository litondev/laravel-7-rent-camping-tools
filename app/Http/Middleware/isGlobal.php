<?php

namespace App\Http\Middleware;

use Closure;
use Auth,Config;
use App\Models\OrderItem;

class isGlobal
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
        // JIKA SUDAH LOGIN
        if(Auth::user()){
            // AMBIL DATA CART DARI YANG LOGIN
            Config::set("app.user_cart",
                OrderItem::where("user_id",Auth::user()->id)->where("status","cart")->count()
            );
        }

        return $next($request);
    }
}
