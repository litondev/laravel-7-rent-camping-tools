<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
	OrderItem,
	Product
};
use Auth,DB;
use Carbon\Carbon;

class CartController extends Controller
{
    function index(Request $request){
    	$cart = OrderItem::with("product")
        ->where("user_id",Auth::user()->id)
        ->where("status","cart")
        ->orderBy("id","desc")
        ->get();

    	return view("user.cart",compact("cart"));
    }

    function subCart(Request $request,$id){
		if(OrderItem::where("id",$id)
            ->where("status","cart")
            ->where("user_id",Auth::user()->id)
            ->delete()){
    		return redirect()
            ->back()
            ->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => "Berhasil Hapus Data"
                ]
            ]);
    	}

    	return redirect()
        ->back()
        ->with([
            "error" => [
                "title" => "Terjadi Kesalahan",
                "text" => "Gagal Hapus Data"
            ]
        ]);
    }

    function addCart(Request $request,$id){
        // CEK PRODUCT
    	if(!Product::where("id",$id)
            ->where("status","aktif")
            ->first()){
    	   return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Product tidak ditemukan atau tidak aktif"
                ]
            ]);
    	}    

        //  CEK PRODUCT JIKA DI KERANJANG
    	if(OrderItem::where("product_id",$id)
            ->where("status","cart")
            ->where("user_id",Auth::user()->id)
            ->first()){
    		return redirect()
            ->back()
            ->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => "Berhasil Menambahkan Cart"
                ]
            ]);
    	}

        // CEK PRODUCT JIKA MAX KERANJANG
     	if(OrderItem::where("user_id",Auth::user()->id)
            ->where("status","cart")
            ->count() >= intval(config("app.max_order"))){
            return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Anda telah mencapai limit order"
                ]
            ]);
        }

        // CEK PRODUCT JIKA TERSEWA
        if(Product::where("id",$id)
            ->where("status_rent",1)
            ->first()){
            return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Maaf product sudah tersewa"
                ]
            ]);
        }

    	if(OrderItem::create([
    		"product_id" => $id,
    		"user_id" => Auth::user()->id,
    		"status" => "cart"    		
    	])){
    		return redirect("/cart")
            ->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => "Berhasil Menambahkan Cart"
                ]
            ]);
    	}

       	return redirect()
        ->back()
        ->with([
            "error" => [
                "title" => "Terjadi Kesalahan",
                "text" => "Gagal menambahkan cart"
            ]
        ]);
    }

    function subsCart(Request $request){
        if($request->has("id")){
            if(is_array($request->id)){
                foreach ($request->id as $item) {
                    if(OrderItem::where("id",intval($item))
                        ->where("status","cart")
                        ->first()){
                        OrderItem::where("id",intval($item))
                            ->where("status","cart")
                            ->delete();
                    }
                }

                return redirect()
                ->back()
                ->with([
                    "success" => [
                        "title" => "Berhasil",
                        "text" => "Berhasil menghapus cart"
                    ]
                ]);
            }
        }  

        return redirect()
        ->back()
        ->with([
            "error" => [
                "title" => "Terjadi Kesalahan",
                "text" => "Gagal menghapus cart"
            ]
        ]);
    }   
}
