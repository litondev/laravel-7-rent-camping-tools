<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Info;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager as Image;

class InfoController extends Controller
{
    function index(Request $request){
    	$info = new Info();

    	if($request->has('form_id') && $request->has('to_id') && !empty($request->form_id) && !empty($request->has('to_id'))){
    		$info = $info->whereBetween("id",[$request->form_id,$request->to_id]);
    	}

    	if($request->has('title') && !empty($request->title)){
    		$info = $info->where('title','like','%'.$request->title.'%');
    	}    	

    	if($request->has('search_created_at') && !empty($request->search_created_at)){
    		$dateCreated = explode(" - ",$request->search_created_at);
        
            if(is_array($dateCreated)){              
            	$startDate = $dateCreated[0];
            	$endDate = $dateCreated[1];

            	$info = $info->whereBetween("created_at",[$startDate,$endDate]);
            }
    	}

    	$info = $info->orderBy('id','desc')->paginate(10);
   
    	return view("admin.info",compact("info","request"));
    }

    function addInfo(Request $request){
		$validator = \Validator::make($request->all(), [           
           'title' => 'required',
           'sub_title' => 'required',
           'content' => 'required',
           'image' => "required|image|dimensions:max_width=".config('app.image_max_dim').",max_height=".config('app.image_max_dim')."|max:".config('app.image_max_upload')."|mimes:".config('app.image_allow_upload'),
        ],[
           'title.required' => 'Judul harus diisi',
           'sub_title.required' => 'Sub Judul harus diisi',
           'content.required' => 'Kontent harus diisi',
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

        $slug = Str::slug($request->title);

        if(Info::where('slug',$slug)->first()){
        	return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Slug sudah terpakai"
                ]
            ]);
        }

        $payload = $request->only('title','sub_title','content');
        $payload["slug"] = $slug;
        $payload["image"] = $this->uploadImage($request->file("image"));

        if(Info::create($payload)){
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
        $filePath = public_path() . config("app.folder_infos");
        // $image->move($filePath,$filePath."".$fileName);        

        $theImage = new Image();

        $imageChange = $theImage->make($image)->resize(null, 82, function($constraint){
            $constraint->aspectRatio();
        });

        $imageChange->save($filePath."".$fileName);
        
        return $fileName;
    }

    function editInfo(Request $request,$id){
		$validator = \Validator::make($request->all(), [           
           'title' => 'required',
           'sub_title' => 'required',
           'content' => 'required',
           'image' => "image|dimensions:max_width=".config('app.image_max_dim').",max_height=".config('app.image_max_dim')."|max:".config('app.image_max_upload')."|mimes:".config('app.image_allow_upload'),
        ],[
           'title.required' => 'Judul harus diisi',
           'sub_title.required' => 'Sub Judul harus diisi',
           'content.required' => 'Kontent harus diisi',
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

        $info = Info::where('id',$id)->first();

        if(!$info){
        	return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Gagal",
                    "text" => "Gagal Edit Data"
                ]
           	]);
        }

        $payload = $request->only('title','sub_title','content');

        if($request->hasFile('image')){
        	$payload["image"] = $this->uploadImage($request->file("image"));        	
	        $oldImg = $info->image;
	    }

        if($info->update($payload)){
        	if($request->hasFile('image')){
        		if(!empty($oldImg)){
		            $path = public_path().config('app.folder_infos')."".$oldImg;

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

    function deleteInfo(Request $request,$id){
    	$info = Info::where('id',$id)->first();

    	if(!$info){    	
	    	return redirect()
	        ->back()
	        ->with([
	            "error" => [
	                "title" => "Terjadi Kesalahan",
	                "text" => "Gagal Hapus Data"
	            ]
	        ]);
    	}

    	if($info->delete()){
        	if(!empty($info->image)){
	            $path = public_path().config('app.folder_infos')."".$info->image;

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
}
