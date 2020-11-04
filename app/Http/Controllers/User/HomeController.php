<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
   Info,
   Product,
   Category,
   Slider,
   Wishlist,
   OrderItem,
   Review
};
use DB;

class HomeController extends Controller
{
   function index(Request $request){
      // SLIDER YANG AKTIF
      $slider = Slider::where("status","aktif")->get();

      // KATEGORI YANG AKTIF
      $category = Category::where("status","aktif")->get();

      // PRODUCT YANG AKTIF
      $product = Product::where("status","aktif")
         ->orderBy("id","desc")
         ->take(16)
         ->get();      

      // DAFTAR KEINGINAN TERBARU
      $wishlist = Wishlist::with('product')      
         ->select("product_id")
         ->groupBy('product_id')
         ->orderBy('id','desc')
         ->take(5)
         ->get();

      // PRODUCT TERSEWA TERBANYAK
      $mostRent = OrderItem::where("status","invoice")
      ->with(["invoice","product"]) 
      ->whereHas("invoice",function($q){
         $q->where("status_payment","paid");
      })
      ->orderBy("id","desc")
      ->take(15)
      ->get();

      return view("user.index",compact("slider","wishlist","category","product","mostRent"));
   }

   function info(Request $request){   	  
      return view("user.info",["info" => Info::all()]);
   }

   function infoDetail(Request $request,$slug){
		if(Info::where("slug",$slug)->first()){
			return view("user.info-detail",[
            "info" =>Info::where("slug",$slug)->first()
         ]);
		}

		return redirect()->back();
   }

   function product(Request $request){
      $product = new Product();

      $product = $product->with("category");

      if($request->has("search")){
         $product = $product->where("name","like","%".$request->search."%");
      }

      if($request->has("category")){
         $category = $request->category;

         $product = $product->whereHas("category",function($q) use ($category){
            $q->where("name",$category);
         });
      }

      if($request->has("price")){
         if($request->price == "termahal"){
            $product = $product->orderBy("rent_price","desc");
         }else{
            $product = $product->orderBy("rent_price","asc");
         }
      }else{
         $product = $product->orderBy("id","desc");
      }

      $product = $product->where("status","aktif")->paginate(12);

      $category = Category::where("status","aktif")->get();

      $query_search = $request->search ?? false;
      $query_category = $request->category ?? false; 
      $query_price = $request->price ?? false;

      return view("user.product",compact("product","category","query_search","query_category","query_price"));
   }

   function akun(Request $request){
      return view("user.akun");
   }

   function productDetail(Request $request,$id){
      $product = Product::withCount("reviews")
      ->withCount("wishlists")
      ->with('category')
      ->where("status","aktif")
      ->where("id",$id)
      ->first();
  
      // JIKA PRODUCT TIDAK DITEMUKAN ATAU
      if(!$product){
         return redirect()->back()
         ->with([
               "error" => [
                  "title" => "Terjadi Kesalahan",
                  "text" => "Product tidak ditemukan atau tidak aktif"
               ]
         ]);
      }

      // PRODUCT TERKAIT
      $productRelevan = Product::where("category_id",$product->category_id)
      ->orderBy("id","desc")
      ->whereNotIn("id",[$id])
      ->take(4)
      ->get();

      // REVIEW PRODUCT
      $productReview = Review::with('user')
      ->where("product_id",$id)
      ->orderBy("id","desc")
      ->paginate(5);

      $productDetail = false;
      
      if($request->productDetail){
         $productDetail = $request->productDetail;
      }

      return view("user.product-detail",compact("product","productRelevan","productReview","productDetail"));
   }
}
