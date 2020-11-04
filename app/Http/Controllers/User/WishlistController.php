<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
	Wishlist,
	Product 
};
use Auth;

class WishlistController extends Controller
{
    function index(Request $request){
    	$wishlist = Wishlist::where("user_id",Auth::user()->id)
        ->orderBy("id","desc")
        ->paginate(6);

    	return view("user.wishlist",compact("wishlist"));
    }

    function addWishlist(Request $request,$id){    
        // JIKA PRODUCT TIDAK AKTIF ATAU ID TIDAK ADA
    	if(!Product::where("id",$id)
            ->where("status","aktif")
            ->first()){
    	   return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Gagal Menambahkan Keinginan"
                ]
            ]);
    	}

        // JIKA SUDAH ADA PRODUCT DI DAFTAR KEINGINAN
    	if(Wishlist::where("product_id",$id)
            ->where("user_id",Auth::user()->id)
            ->first()){
    		return redirect()
            ->back()
            ->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => "Berhasil Menambahkan Keinginan"
                ]
            ]);
    	}

        // CEK LIMIT DAFTAR KEINGINAN
        if(Wishlist::where("user_id",Auth::user()->id)->count() >= intval(config("app.max_wishlist"))){
            return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Anda telah mencapai limit daftar keinginan"
                ]
            ]);
        }

    	if(Wishlist::create([
    		"product_id" => $id,
    		"user_id" => Auth::user()->id
    	])){
    		return redirect()
            ->back()
            ->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => "Berhasil Menambahkan Keinginan"
                ]
            ]);
    	}

        return redirect()
        ->back()
        ->with([
            "error" => [
                "title" => "Terjadi Kesalahan",
                "text" => "Gagal Menambahkan Keinginan"
            ]
        ]);
    }

    function subWishlist(Request $request,$id){
    	if(Wishlist::where("id",$id)->where("user_id",Auth::user()->id)->delete()){
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
}
