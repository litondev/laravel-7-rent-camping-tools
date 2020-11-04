<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    function signin(Request $request){
    	return view("user.signin");
    }

    function signup(Request $request){
    	return view("user.signup");
    }

    function resetPassword(Request $request){      
        if(!empty($request->email) && !empty($request->key)){
            if(User::where("email",$request->email)
                ->where("remember_token",$request->key)
                ->first()){
    	       return view("user.reset-password",[
                "email" => $request->email,
                "key" => $request->key
               ]);
            }
        }

        return redirect("/forget-password");
    }

    function forgetPassword(Request $request){
    	return view("user.forget-password");
    }

    function logout(Request $request){
        \Auth::logout();
                
        return redirect("/");
    }
}
