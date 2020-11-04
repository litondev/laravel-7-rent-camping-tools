<?php

namespace App\Http\Middleware;

use Closure;
use Auth,Config;
use App\Models\NotifAdmin;

class isAdmin
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
        // JIKA BELUM LOGIN
        if(!Auth::user()){
            return redirect("/");
        }

        // JIKA ROLE TIDAK ADMIN
        if(Auth::user()->role != "admin"){
            return redirect("/");
        }

        // AMBIL 3 NOTIF ADMIN YANG TERAKHIR
        Config::set("app.notif_admin",
            NotifAdmin::orderBy('id','desc')
            ->take(3)
            ->get()
        );
        
        return $next($request);
    }
}
