<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
	Review,
	OrderItem,
	Invoice,
	Product,
    NotifAdmin
};
use Auth,DB;

class ReviewController extends Controller
{
    public function reviewProduct(Request $request){
    	$validator = \Validator::make($request->all(), [
    		'star' => 'required|integer',
    		'komentar' => 'required',
    		'product_id' => 'required|integer',
    		'invoice_id' => 'required|integer'
        ],[
        	'star.required' => 'Bintang harus diisi',
        	'star.integer' => 'Bintang tidak valid',
        	'komentar.required' => 'Description harus diisi',
        	'product_id.required' => 'Product id harus diisi',
        	'product_id.integer' => 'Product id tidak valid',
        	'invoice_id.required' => "Invoice id harus diisi",
        	'invoice_id.integer' => "Invoice id tidak valid"
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

        // CEK DI ORDER ITEM
        if(!OrderItem::where("user_id",Auth::user()->id)
        ->where("product_id",$request->product_id)
        ->where("invoice_id",$request->invoice_id)
        ->where("status","invoice")
        ->first()){
        	return redirect()
        	->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Maaf spertinya data ada yang tidak valid"
                ]
            ]);
        };

        // CEK DI INVOICE 
        if(!Invoice::where('id',$request->invoice_id)
        	->where("user_id",Auth::user()->id)
        	->whereIn("status",["in rent","backing stuff"])
        	->first()){
        	return redirect()
        	->back()
        	->with([
        		"error" => [
        			"title" => "Terjadi Kesalahan",
        			"text" => "Maaf sepertinya data invoice sudah tidak valid"
        		]
        	]);
        }

        try{
            DB::beginTransaction();

    		if(Review::create([
	    		"user_id" => Auth::user()->id,
    			"product_id" => $request->product_id,
    			"star" => $request->star,
    			"komentar" => $request->komentar,    		
    		])){
	 			$ratings = Review::select(
	                DB::raw("sum(star) as value"),
	                DB::raw("count(*) as total")
	            )
	           ->where("product_id",$request->product_id)
	           ->first();     

	        	if(!empty($ratings)){
		            $value = intval($ratings->value);
	            	$rating = 0;            

		            $rcount = intval($ratings->total);

	            	if($rcount > 0){
		                $rating = round(($value/$rcount));
	            	}

	            	Product::where("id",$request->product_id)->update([
		                "star" => $rating
	            	]);
	        	}           

                NotifAdmin::create([
                    "content" => "User ".Auth::user()->first_name." telah mereview product #".$request->product_id
                ]);
                
    			DB::commit();

    			return redirect("product/".$request->product_id."?productDetail=komentar")    			
    			->with([
    				"success" => [
    					"title" => "Berhasil",
    					"text" => "Berhasil memberi review product"
    				]
    			]);
    		}

    		DB::rollback();

    		return redirect()
    		->back()	
    		->with([
	    		"error" => [
    				"title" => "Terjadi Kesalahan",
    				"text" => "Maaf tidak dapat membuat review"
    			]
    		]);
        }catch(\Exception $e){
        	DB::rollback();

        	\Log::info($e);

			return redirect()
    		->back()	
    		->with([
	    		"error" => [
    				"title" => "Terjadi Kesalahan",
    				"text" => "Maaf tidak dapat membuat review"
    			]
    		]);
        }
    }
}
