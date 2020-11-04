<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager as Image;

class SliderController extends Controller
{
    function index(Request $request){
    	$slider = new Slider();

    	if($request->has('form_id') && $request->has('to_id') && !empty($request->form_id) && !empty($request->has('to_id'))){
    		$slider = $slider->whereBetween("id",[$request->form_id,$request->to_id]);
    	}

    	if($request->has('status') && !empty($request->status)){
    		$slider = $slider->where('status',$request->status);
    	}

    	if($request->has('search_created_at') && !empty($request->search_created_at)){
    		$dateCreated = explode(" - ",$request->search_created_at);
        
            if(is_array($dateCreated)){              
            	$startDate = $dateCreated[0];
            	$endDate = $dateCreated[1];

            	$slider = $slider->whereBetween("created_at",[$startDate,$endDate]);
            }
    	}

    	$slider = $slider->orderBy('id','desc')->paginate(10);
   
    	return view("admin.slider",compact("slider","request"));
    }

    function deleteSlider(Request $request,$id){
    	$slider = Slider::where('id',$id)->first();

    	if(!$slider){    	
	    	return redirect()
	        ->back()
	        ->with([
	            "error" => [
	                "title" => "Terjadi Kesalahan",
	                "text" => "Gagal Hapus Data"
	            ]
	        ]);
    	}

    	if($slider->delete()){
        	if(!empty($slider->image)){
	            $path = public_path().config('app.folder_sliders')."".$slider->image;

            	if(file_exists($path)){            
	                unlink($path);     
            	}
        	}

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

    function changestatus(Request $request,$id,$status){    	
    	if($status != "aktif" && $status != "nonaktif"){
    		return redirect()
	        ->back()
	        ->with([
	            "error" => [
	                "title" => "Terjadi Kesalahan",
	                "text" => "Gagal Ubah Status"
	            ]
	        ]);
    	}

		$slider = Slider::where('id',$id)->first();

    	if(!$slider){    	
	    	return redirect()
	        ->back()
	        ->with([
	            "error" => [
	                "title" => "Terjadi Kesalahan",
	                "text" => "Gagal Ubah Status"
	            ]
	        ]);
    	}

    	if($slider->update(['status' => $status])){
    		return redirect()
    			->back()
    			->with([
    				"success" => [
    					"title" => "Berhasil",
    					'text' => "Berhasil Ubah Status"
    				]
    			]);
    	}

    	return redirect()
	        ->back()
	        ->with([
	            "error" => [
	                "title" => "Terjadi Kesalahan",
	                "text" => "Gagal Ubah Status"
	            ]
	        ]);
    }

    function addSlider(Request $request){
    	$validator = \Validator::make($request->all(), [                   
           'link' => 'required|url',
           'image' => "required|image|dimensions:max_width=".config('app.image_max_dim').",max_height=".config('app.image_max_dim')."|max:".config('app.image_max_upload')."|mimes:".config('app.image_allow_upload'),
        ],[
           'link.required' => 'Link harus diisi',           
           'link.url' => 'Link tidak valid',
           'image.required' => 'Gambar harus diisi',
           'image.image' => 'Gambar tidak valid',
           'image.dimensions' => 'Gambar dimensi tidak valid',
           'image.max' => 'Gambar max size tidak valid',
           'image.mimes' => 'Gambar tidak valid'
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

        $payload = $request->only('link');
        $payload["image"] = $this->uploadImage($request->file("image"));

        if(Slider::create($payload)){
        	return redirect()
            ->back()
            ->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => "Berhasil Tambah Data"
                ]
            ]);
        }

        return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Gagal Tambah Data"
                ]
        	]);
    }

    function uploadImage($image){
 		$extension = $image->getClientOriginalExtension();
        $fileName = Str::random("20").'.' . $extension;
        $filePath = public_path() . config("app.folder_sliders");
        // $image->move($filePath,$filePath."".$fileName);        

        $theImage = new Image();

        $imageChange = $theImage->make($image)->resize(null, 756, function($constraint){
            $constraint->aspectRatio();
        });

        $imageChange->save($filePath."".$fileName);
        
        return $fileName;
    }
}
