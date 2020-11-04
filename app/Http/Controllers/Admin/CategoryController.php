<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager as Image;

class CategoryController extends Controller
{
    function index(Request $request){
    	$category = new Category();

		if($request->has('form_id') && $request->has('to_id') && !empty($request->form_id) && !empty($request->has('to_id'))){
    		$category= $category->whereBetween("id",[$request->form_id,$request->to_id]);
    	}

    	if($request->has('name') && !empty($request->name)){
    		$category = $category->where('name','like','%'.$request->name.'%');
    	}    	

		if($request->has('status') && !empty($request->status)){
    		$category = $category->where('status',$request->status);
    	}

    	if($request->has('search_created_at') && !empty($request->search_created_at)){
    		$dateCreated = explode(" - ",$request->search_created_at);
        
            if(is_array($dateCreated)){              
            	$startDate = $dateCreated[0];
            	$endDate = $dateCreated[1];

            	$category = $category->whereBetween("created_at",[$startDate,$endDate]);
            }
    	}

    	$category = $category->orderBy('id','desc')->paginate(10);

    	return view("admin.category",compact('category','request'));
    }

    function editCategory(Request $request,$id){
    	$validator = \Validator::make($request->all(), [           
           'name' => 'required',
           'image' => "image|dimensions:max_width=".config('app.image_max_dim').",max_height=".config('app.image_max_dim')."|max:".config('app.image_max_upload')."|mimes:".config('app.image_allow_upload'),
        ],[
           'name.required' => 'Nama harus diisi',         
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

        $category = Category::where('id',$id)->first();

        if(!$category){
        	return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Gagal",
                    "text" => "Gagal Edit Data"
                ]
           	]);
        }

        $payload = $request->only('name');

        if($request->hasFile('image')){
        	$payload["image"] = $this->uploadImage($request->file("image"));        	
	        $oldImg = $category->image;
	    }

        if($category->update($payload)){
        	if($request->hasFile('image')){
        		if(!empty($oldImg)){
		            $path = public_path().config('app.folder_categories')."".$oldImg;

            		if(file_exists($path)){            
		                unlink($path);     
            		}
        		}
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

        return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Gagal",
                    "text" => "Gagal Edit Data"
                ]
           	]);
    }

    function changeStatus(Request $request,$id,$status){
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

		$category = Category::where('id',$id)->first();

    	if(!$category){    	
	    	return redirect()
	        ->back()
	        ->with([
	            "error" => [
	                "title" => "Terjadi Kesalahan",
	                "text" => "Gagal Ubah Status"
	            ]
	        ]);
    	}

    	if($category->update(['status' => $status])){
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

    function addCategory(Request $request){
    	$validator = \Validator::make($request->all(), [                   
           'name' => 'required',
           'image' => "required|image|dimensions:max_width=".config('app.image_max_dim').",max_height=".config('app.image_max_dim')."|max:".config('app.image_max_upload')."|mimes:".config('app.image_allow_upload'),
        ],[
           'name.required' => 'Nama harus diisi',           
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

        $payload = $request->only('name');
        $payload["image"] = $this->uploadImage($request->file("image"));
        $payload["status"] = "aktif";

        if(Category::create($payload)){
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
        $filePath = public_path() . config("app.folder_categories");

        // $image->move($filePath,$filePath."".$fileName);        

        $theImage = new Image();

        $imageChange = $theImage->make($image)->resize(null, 82, function($constraint){
            $constraint->aspectRatio();
        });

        $imageChange->save($filePath."".$fileName);

        return $fileName;
    }
}
