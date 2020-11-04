<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notif;
use Auth;

class NotifController extends Controller
{	
    function index(Request $request){
    	$notif = Notif::where("user_id",Auth::user()->id)
    	->orderBy("id","desc")
    	->paginate(6);
    	
    	return view("user.notif",compact("notif"));
    }
}
