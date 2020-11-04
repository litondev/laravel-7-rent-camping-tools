<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ProfilController extends Controller
{
    function index(Request $request){
    	$tab = false;

    	if($request->tab){
    		if($request->tab == "data" || $request->tab == "password"){	
    			$tab = $request->tab;
    		}
    	}

    	return view("user.profil",compact("tab"));
    }

    function updateData(Request $request){
		$validator = \Validator::make($request->all(), [
    		'first_name' => 'required',
    		'last_name' => 'required',
    		'phone' => 'required',
    		'address' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
            'password' => 'required|min:8',
        ],[
        	'first_name.required' => 'Nama Depan harus diisi',
        	'last_name.required' => 'Nama Belakang harus diisi',
        	'phone.required' => 'No Telp harus diisi',
        	'address.required' => 'Alamat harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email'  => 'Format email tidak sesuai',
            'email.unique' => "Email telah terpakai",
            'password.required'  => 'Password harus diisi',
            'password.min'  => 'Password harus :min karakter',
        ]);

        if ($validator->fails()) {
        	return redirect("/profil?tab=data")
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => $validator->errors()->first()
                ]
            ]);
        }

        $user = User::where("id",Auth::user()->id)->first();

        // CEK PASSWORD VALID
        if (!\Hash::check($request->password, $user->password)) {
        	return redirect("/profil?tab=data")
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Password konfirmasi tidak valid"
                ]
            ]);        	
        }        

        $payload = $request->only("first_name","last_name","phone","address",'email');

        // CEK PHONE VALID
        $mobile_phone = preg_replace('/[^0-9\+]/','',strval($payload['phone']));
        if(substr($mobile_phone, 0,2) != '08'){
           return redirect("/profil?tab=data")
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

        // CEK PHONE UNIQUE
        if(User::where('phone',intval($payload['phone']))
            ->whereNotIn("id",[Auth::user()->id])
            ->first()){
           return redirect("/profil?tab=data")
           ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "No telp telah terpakai"
                ]
            ]);
        }

        if(User::where("id",Auth::user()->id)->update($payload)){
        	return redirect("/profil?tab=data")
            ->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => "Berhasil update data"
                ]
            ]);
        }

        return redirect("/profil?tab=data")
        ->with([
            "error" => [
                "title" => "Terjadi Kesalahan",
                "text" => "Gagal update data"
            ]
        ]);
    }

    function updatePassword(Request $request){
    	$validator = \Validator::make($request->all(), [    		
            'password' => 'required|min:8',
            'password_baru' => 'required|min:8'
        ],[        	
            'password.required'  => 'Password harus diisi',
            'password.min'  => 'Password harus :min karakter',
            'password_baru.required'  => 'Password harus diisi',
            'password_baru.min'  => 'Password harus :min karakter',
        ]);

        if ($validator->fails()) {
        	return redirect("/profil?tab=password")
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => $validator->errors()->first()
                ]
            ]);
        }	

        $user = User::where("id",Auth::user()->id)->first();

        // CEK PASSWORD VALID
        if (!\Hash::check($request->password, $user->password)) {
        	return redirect("/profil?tab=password")
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Password Konfirmasi Tidak Valid"
                ]
            ]);        	
        } 

        $payload = [];

        $payload['password'] = \Hash::make($request->password_baru);

        if(User::where("id",Auth::user()->id)->update($payload)){
        	return redirect("/profil?tab=password")
            ->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => "Berhasil update data"
                ]
            ]);
        }

        return redirect("/profil?tab=password")
        ->with([
            "error" => [
                "title" => "Terjadi Kesalahan",
                "text" => "Gagal update data"
            ]
        ]);
    }
}
