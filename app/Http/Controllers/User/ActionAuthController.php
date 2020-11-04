<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    User,
    LogAdmin
};
use Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ActionAuthController extends Controller
{
    function signin(Request $request){
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ],[
            'email.required' => 'Email harus diisi',
            'email.email'  => 'Format email tidak sesuai',
            'password.required'  => 'Password harus diisi',
            'password.min'  => 'Password harus :min karakter',
        ]);

        if ($validator->fails()) {
        	return redirect()
            ->back()
            ->withInput()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => $validator->errors()->first()
                ]
            ]);
        }
    
    	// MENCARI EMAIL
        if(!User::where("email",$request->email)->first()){
       		return redirect()
            ->back()
            ->withInput()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Email tidak ditemukan"
                ]
            ]);
        }
        
        $credentials = $request->only("email","password");

        if(Auth::attempt($credentials)){

            // PERIKSA APAKAH USER TERBLOKIR
            if(Auth::user()->status != "aktif" && !empty(Auth::user()->description_blokir)){
                $user = Auth::user();    

                Auth::logout();

                return redirect()
                ->back()
                ->with([
                    "error" => [
                        "title" => "Maaf sepertinya anda telah diblokir",
                        "text" => $user->description_blokir
                    ]
                ]);;   
            }

            // UPDATE LOGIN TERAKHIR
            User::where("id",Auth::user()->id)->update([
                "last_login" => Carbon::now()->toDateTimeString()
            ]);

        	if(Auth::user()->role == "user"){              
        		return redirect("/")
                ->with([
                    "success" => [
                        "title" => "Berhasil",
                        "text" => "Berhasil masuk"
                    ]
                ]);;
        	}else{          
                // CATAT LOG ADMIN      
                LogAdmin::create([
                    "name" => Auth::user()->first_name,
                    "ip" => $request->ip(),
                    "user_agent" => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null
                ]);

        		return redirect("/admins")
                ->with([
                    "success" => [
                        "title" => "Berhasil",
                        "text" => "Berhasil masuk admin"
                    ]
                ]);;
        	}        
        }

        // PASTI KALAU TIDAK BERHASIL LOGIN PASTI KARENA PASSWORD SALAH
        return redirect()
        ->back()
        ->withInput()
        ->with([
            "error" => [
                "title" => "Terjadi Kesalahan",
                "text" => "Password salah"
            ]
        ]);
    }

    function signup(Request $request){
    	$validator = \Validator::make($request->all(), [
    		'first_name' => 'required',
    		'last_name' => 'required',
    		'phone' => 'required',
    		'gender' => 'required',
    		'address' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ],[
        	'first_name.required' => 'Nama Depan harus diisi',
        	'last_name.required' => 'Nama Belakang harus diisi',
        	'phone.required' => 'No Telp harus diisi',
        	'gender.required' => 'Jenis Kelamin harus diisi',
        	'address.required' => 'Alamat harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email'  => 'Format email tidak sesuai',
            'email.unique' => "Email telah terpakai",
            'password.required'  => 'Password harus diisi',
            'password.min'  => 'Password harus :min karakter',
        ]);

        if ($validator->fails()) {
        	return redirect()
            ->back()
            ->withInput()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => $validator->errors()->first()
                ]
            ]);
        }

        $payload = $request->only("first_name","last_name","phone","gender","address",'email');

        $payload['password'] = \Hash::make($request->password);

        // VALIDASI PHONE
        $mobile_phone = preg_replace('/[^0-9\+]/','',strval($payload['phone']));
        if(substr($mobile_phone, 0,2) != '08'){
           return redirect()
           ->back()
           ->withInput()
           ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "No telp harus 08"
                ]
            ]);
        }
        $validPhone = substr($mobile_phone, 0,2);
        $noBelakang = explode($validPhone,$mobile_phone)[1];
        $payload['phone'] = $validPhone . preg_replace('/[^0-9]/','',strval($noBelakang));                                        

        // CEK MOBILE UNIQUE
        if(User::where('phone',$payload['phone'])->first()){
           return redirect()
            ->back()
            ->withInput()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "No telp telah terpakai"
                ]
            ]);
        }

        if(User::create($payload)){
           return redirect("/signin")
           ->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => "Berhasil mendaftar"
                ]
            ]);
        }

        return redirect()
        ->back()
        ->withInput()
        ->with([
            "error" => [
                "title" => "Terjadi Kesalahan",
                "text" => "Tidak dapat mendafatar"
            ]
        ]);
    }

    function forgetPassword(Request $request){
    	$validator = \Validator::make($request->all(), [    	
            'email' => 'required|email',
        ],[        	
            'email.required' => 'Email harus diisi',
            'email.email'  => 'Format email tidak sesuai',           
        ]);

        if ($validator->fails()) {
        	return redirect()
            ->back()
            ->withInput()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => $validator->errors()->first()
                ]
            ]);
        }

        // CEK EMAIL
        if(!User::where('email',$request->email)->first()){
        	return redirect()
            ->back()
            ->withInput()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Email tidak ditemukan"
                ]
            ]);
        }

    	$user = User::where("email",$request->email)->first();        
        $key = Str::random("10");

        $subject = "lupa password ".$user->first_name;

        $content = "<div>";
        $content .= "<span class='title-email-camp'>Hello ".$user->first_name."</span>";
         $content .= "<br>";
         $content .= "<br>";
        $content .= "<span class='text-email-camp'>Klik link dibawah ini untuk reset password</span>";
         $content .= "<br>";
        $content .= "<a href='".url('reset-password?email='.$user->email.'&key='.$key)."' class='text-email-camp'>Klik</a>";
        $content .= "</div>";

	    \Mail::to($user->email)->send(new \App\Mail\SendEmail($subject,$content));
    
    	$user->remember_token =  $key;
    	$user->save();

    	return redirect()
        ->back()
        ->with([
            "success" => [
                "title" => "Berhasil",
                "text" => "Email verifikasi password baru telah terkirim,Silahkan cek email"
            ]
        ]);    
    }

    function resetPassword(Request $request){
    	$validator = \Validator::make($request->all(), [    	
    		'key' => "required",
    		'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ],[        	
        	'key.required' => 'Key tidak ditemukan',
        	'email.required' => "Email harus diisi",
            'email.email'  => 'Format email tidak sesuai',           
            'password.required'  => 'Password harus diisi',
            'password.min'  => 'Password harus :min karakter',          
            'password.confirmed' => 'Password harus sama',
            'ppassword_confirmation.required' => 'Password confirm harus diisi',
            'password_confirmation.min' => 'Password confirm :min karakter'
        ]);

        if ($validator->fails()) {
        	return redirect()
            ->back()
            ->withInput()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => $validator->errors()->first()
                ]
            ]);
        }

        $user = User::where("email",$request->email)
        ->where("remember_token",$request->key)
        ->first();

        if($user){
        	$user->password = \Hash::make($request->password);
        	$user->save();
        	
        	return redirect("/signin")
            ->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => "Berhasil reset password"
                ]
            ]);
        }

        return redirect()
        ->back()
        ->withInput()
        ->with([
            "error" => [
                "title" => "Terjadi Kesalahan",
                "text" => "Maaf sepertinya data sudah tidak valid"
            ]
        ]);
    }
}
