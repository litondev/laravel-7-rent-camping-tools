<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class InvoiceController extends Controller
{
    function index(Request $request){
    	return view("admin.setting.invoice");
    }

    function editInvoice(Request $request){
    	$validator = \Validator::make($request->all(), [           
           'expired_invoice' => 'required|integer',
           'time_backing_stuff' => 'required|integer'
        ],[
           'expired_invoice.required' => 'Kadaluarsa invoice harus diisi',
           'expired_invoice.integer' => 'Kadaluarsa invoice tidak valid',
           'time_backing_stuff.required' => 'Waktu pengembalian barang harus diisi',
           'time_backing_stuff.integer' => 'Waktu pengembalian barang tidak valid'
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
