<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class WebsiteController extends Controller
{
    function index(Request $request){
    	return view("admin.setting.website");
    }

    function editWebsite(Request $request){
    	$validator = \Validator::make($request->all(), [           
           'site_name' => 'required',
           'meta_description' => 'required',
           'footer_contact_us' => 'required',
           'city' => 'required'
        ],[
        	'site_name.required'  => 'Nama website harus diisi',
        	'meta_description.required' => 'Meta harus diisi',
        	'footer_contact_us.required' => 'Kontak kami harus diisi',
        	'city.required' => 'Kota harus disi'
        ]);

        if ($validator->fails()) {
        	return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => $validator->errors()->first()
                ]
            ]);
        }

 		foreach($request->all() as $key => $item){
 			Setting::where('name',$key)->update([
 				'value' => $item
 			]);
 		}

 		return redirect()
            ->back()
            ->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => "Berhasil Edit Data"
                ]
           	]);
    }
}
