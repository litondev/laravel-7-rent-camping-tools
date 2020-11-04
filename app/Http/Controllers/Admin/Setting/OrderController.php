<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class OrderController extends Controller
{
    function index(Request $request){
    	return view("admin.setting.order");
    }
   
    function editOrder(Request $request){
    	$validator = \Validator::make($request->all(), [           
           'max_order' => 'required|integer',
           'max_wishlist' => 'required|integer',
           'max_rent_product' => 'required|integer',
           'min_rent_product' => 'required|integer'
        ],[
        	'max_order.required' => 'Max order harus diisi',
        	'max_order.integer'  => 'Max order tidak valid',
        	'max_wishlist.required' => 'Max daftar keinginan harus diisi',
        	'max_wishlist.integer' => 'Max daftar keinginan tidak valid',
        	'max_rent_product.required' => 'Max waktu rental product harus diisi',
        	'max_rent_product.integer' => 'Max waktu rental product tidak valid',
        	'min_rent_product.required' => 'Min waktu rental product harus diisi',
        	'min_rent_product.integer' => 'Min waktu rental product tidak valid'
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
