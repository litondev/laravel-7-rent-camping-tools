<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Review,
    Product
};
use DB;

class ReviewController extends Controller
{
    function index(Request $request){
    	$review = new Review();

    	$review = $review->with(["user","product"]);

        if($request->has('form_id') && $request->has('to_id') && !empty($request->form_id) && !empty($request->has('to_id'))){
            $review = $review->whereBetween("id",[$request->form_id,$request->to_id]);
        }

    	if($request->has('product_name') && !empty($request->product_name)){
    		$search = $request->product_name;

    		$review = $review->whereHas("product",function($q) use ($search) {
    			$q->where("name","like","%".$search."%");
    		});
    	}

    	if($request->has('first_name') && !empty($request->first_name)){
    		$search = $request->first_name;
    		
    		$review = $review->whereHas("user",function($q) use ($search){
    			$q->where('first_name','like','%'.$search.'%');
    		});
    	}

        if($request->has('komentar') && !empty($request->komentar)){
            $review = $review->where("komentar","like","%".$request->komentar."%");
        }

        if($request->has('star') && !empty($request->star)){
            $review = $review->where('star',intval($request->star));
        }

        if($request->has('search_created_at') && !empty($request->search_created_at)){
            $dateCreated = explode(" - ",$request->search_created_at);
        
            if(is_array($dateCreated)){              
                $startDate = $dateCreated[0];
                $endDate = $dateCreated[1];

                $review = $review->whereBetween("created_at",[$startDate,$endDate]);
            }
        }

    	$review = $review->orderBy('id','desc')->paginate(10);

    	return view("admin.review",compact('review','request'));
    }

    function reviewNegatif(Request $request){
        $review = new Review();

        $review = $review->with(["user","product"]);

        if($request->has('form_id') && $request->has('to_id') && !empty($request->form_id) && !empty($request->has('to_id'))){
            $review = $review->whereBetween("id",[$request->form_id,$request->to_id]);
        }

        if($request->has('product_name') && !empty($request->product_name)){
            $search = $request->product_name;

            $review = $review->whereHas("product",function($q) use ($search) {
                $q->where("name","like","%".$search."%");
            });
        }

        if($request->has('first_name') && !empty($request->first_name)){
            $search = $request->first_name;
            
            $review = $review->whereHas("user",function($q) use ($search){
                $q->where('first_name','like','%'.$search.'%');
            });
        }

        if($request->has('komentar') && !empty($request->komentar)){
            $review = $review->where("komentar","like","%".$request->komentar."%");
        }     

        if($request->has('search_created_at') && !empty($request->search_created_at)){
            $dateCreated = explode(" - ",$request->search_created_at);
        
            if(is_array($dateCreated)){              
                $startDate = $dateCreated[0];
                $endDate = $dateCreated[1];

                $review = $review->whereBetween("created_at",[$startDate,$endDate]);
            }
        }

        $review = $review->whereBetween('star',[1,2])
        ->orderBy('id','desc')
        ->paginate(10);

        return view("admin.review-negatif",compact('review','request'));
    }

    function reviewPositif(Request $request){
        $review = new Review();

        $review = $review->with(["user","product"]);

        if($request->has('form_id') && $request->has('to_id') && !empty($request->form_id) && !empty($request->has('to_id'))){
            $review = $review->whereBetween("id",[$request->form_id,$request->to_id]);
        }

        if($request->has('product_name') && !empty($request->product_name)){
            $search = $request->product_name;

            $review = $review->whereHas("product",function($q) use ($search) {
                $q->where("name","like","%".$search."%");
            });
        }

        if($request->has('first_name') && !empty($request->first_name)){
            $search = $request->first_name;
            
            $review = $review->whereHas("user",function($q) use ($search){
                $q->where('first_name','like','%'.$search.'%');
            });
        }

        if($request->has('komentar') && !empty($request->komentar)){
            $review = $review->where("komentar","like","%".$request->komentar."%");
        }     

        if($request->has('search_created_at') && !empty($request->search_created_at)){
            $dateCreated = explode(" - ",$request->search_created_at);
        
            if(is_array($dateCreated)){              
                $startDate = $dateCreated[0];
                $endDate = $dateCreated[1];

                $review = $review->whereBetween("created_at",[$startDate,$endDate]);
            }
        }

        $review = $review->whereBetween('star',[3,4,5])
        ->orderBy('id','desc')
        ->paginate(10);

        return view("admin.review-positif",compact('review','request'));
    }

    function replayReview(Request $request){
        $validator = \Validator::make($request->all(), [           
           'id' => 'required|integer',
           'replay' => 'required'
        ],[
           'id.required' => 'Id harus diisi',
           'id.integer' => 'Id tidak valid',
           'replay.required' => 'Balasan harus diisi'
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

        if(Review::where('id',$request->id)
            ->update([
                'replay' => $request->replay
            ])){            
            return redirect()
            ->back()
            ->with([
                "success" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Berhasil Memberi Review"
                ]
            ]);
        }   

        return redirect()
        ->back()
        ->with([
            "error" => [
                "title" => "Terjadi Kesalahan",
                "text" => "Gagal Memberi Review"
            ]
        ]);
    }

    function deleteReview(Request $request,$id){
        $review = Review::where('id',$id)->first();

        if(!$review){
            return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Gagal Hapus Data"
                ]
            ]);
        }

        try{
            DB::beginTransaction();

            if($review->delete()){
                $ratings = Review::select(
                    DB::raw("sum(star) as value"),
                    DB::raw("count(*) as total")
                )
                ->where("product_id",$review->product_id)
                ->first();     

                if(!empty($ratings)){
                    $value = intval($ratings->value);
                    $rating = 0;            

                    $rcount = intval($ratings->total);

                    if($rcount > 0){
                        $rating = round(($value/$rcount));
                    }

                    Product::where("id",$review->product_id)->update([
                        "star" => $rating
                    ]);
                }        

                DB::commit();

                return redirect()
                ->back()
                ->with([
                    "success" => [
                        "title" => "Berhasil",
                        "text" => "Berhasil Hapus Data"
                    ]
                ]);
            }

            DB::rollback();
            return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Gagal Hapus Data"
                ]
            ]);
        }catch(\Exception $e){
            DB::rollback();

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
}
