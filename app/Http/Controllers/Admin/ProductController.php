<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
	Product,
	Category
};
use Illuminate\Support\Str;

class ProductController extends Controller
{
    function index(Request $request){
    	$product = new Product();

		if($request->has('form_id') && $request->has('to_id') && !empty($request->form_id) && !empty($request->has('to_id'))){
    		$product = $product->whereBetween("id",[$request->form_id,$request->to_id]);
    	}

    	if($request->has('name') && !empty($request->name)){
    		$product = $product->where('name','like','%'.$request->name.'%');
    	}

    	if($request->has('rent_price') && !empty($request->rent_price)){
    		$product = $product->where('rent_price',intval($request->rent_price));
    	}

    	if($request->has('status') && !empty($request->status)){
    		$product = $product->where('status',$request->status);
    	}

    	if($request->has('status_rent') && !empty($request->status_rent)){
    		$product = $product->where('status_rent',intval($request->status_rent));
    	}

    	if($request->has('star') && !empty($request->star)){
    		$product = $product->where('star',intval($request->star));
    	}

    	if($request->has('search_created_at') && !empty($request->search_created_at)){
    		$dateCreated = explode(" - ",$request->search_created_at);
        
            if(is_array($dateCreated)){              
            	$startDate = $dateCreated[0];
            	$endDate = $dateCreated[1];

            	$product = $product->whereBetween("created_at",[$startDate,$endDate]);
            }
    	}

    	$product = $product->withCount('reviews')
    	->orderBy('id','desc')
    	->paginate(10);

    	return view("admin.product",compact("product","request"));
    }

    function productNonaktif(Request $request){
    	$product = new Product();

		if($request->has('form_id') && $request->has('to_id') && !empty($request->form_id) && !empty($request->has('to_id'))){
    		$product = $product->whereBetween("id",[$request->form_id,$request->to_id]);
    	}

    	if($request->has('name') && !empty($request->name)){
    		$product = $product->where('name','like','%'.$request->name.'%');
    	}

    	if($request->has('rent_price') && !empty($request->rent_price)){
    		$product = $product->where('rent_price',intval($request->rent_price));
    	}

    	if($request->has('status_rent') && !empty($request->status_rent)){
    		$product = $product->where('status_rent',intval($request->status_rent));
    	}

    	if($request->has('star') && !empty($request->star)){
    		$product = $product->where('star',intval($request->star));
    	}

    	if($request->has('search_created_at') && !empty($request->search_created_at)){
    		$dateCreated = explode(" - ",$request->search_created_at);
        
            if(is_array($dateCreated)){              
            	$startDate = $dateCreated[0];
            	$endDate = $dateCreated[1];

            	$product = $product->whereBetween("created_at",[$startDate,$endDate]);
            }
    	}

    	$product = $product->where('status','nonaktif')
    	->withCount('reviews')
    	->orderBy('id','desc')
    	->paginate(10);

    	return view("admin.product-nonaktif",compact("product","request"));	
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

		$product = Product::where('id',$id)->first();

    	if(!$product){    	
	    	return redirect()
	        ->back()
	        ->with([
	            "error" => [
	                "title" => "Terjadi Kesalahan",
	                "text" => "Gagal Ubah Status"
	            ]
	        ]);
    	}

    	if($product->update(['status' => $status])){
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

    function editProduct(Request $request,$id){
    	$product = Product::where('id',$id)->first();

    	if(!$product){
			return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => 'Maaf sepertinya ada data yang tidak valid'
                ]
            ]);
    	}

    	$category = Category::all();

    	return view("admin.product-edit",compact('product','category'));
    }

    function edit(Request $request,$id){
    	$validasi = [
    		"id" => "required|integer",
    		"name" => "required",
    		"rent_price" => "required",
    		"category_id" => "required|integer",
    		"description" => "required",
    		"condition" => "required",
    		"fine" => "required",
    		"question" => "required"
    	];

    	$message = [
    		"id.required" => "Id harus diisi",
    		"id.integer" => "Id tidak valid",
    		"name.required" => "Nama harus diisi",
    		"rent_price.required" => "Harga sewa harus diisi",
    		"category_id" => "Kategori harus diisi",
    		"category_id.integer" => "Kategori tidak valid",
    		"description.required" => "Deskripsi harus diisi",
    		"condition.required" => "Syarat dan ketentuan harus diisi",
    		"fine.required" => "Denda harus diisi",
    		"question.required" => "Pertanyaan harus diisi"
    	];

    	if($request->hasFile('image1')){
    		$validasi = array_merge([
           		'image1' => "image|dimensions:max_width=".config('app.image_max_dim').",max_height=".config('app.image_max_dim')."|max:".config('app.image_max_upload')."|mimes:".config('app.image_allow_upload'),
    		],$validasi);

    		$message = array_merge([
    			'image1.image' => 'Gambar 1 tidak valid',
           		'image1.dimensions' => 'Gambar 1 dimensi tidak valid',
           		'image1.max' => 'Gambar 1 max size tidak valid',
           		'image1.mimes' => 'Gambar 1 tidak valid'
    		],$message);
    	}

    	if($request->hasFile('image2')){
    		$validasi = array_merge([
           		'image2' => "image|dimensions:max_width=".config('app.image_max_dim').",max_height=".config('app.image_max_dim')."|max:".config('app.image_max_upload')."|mimes:".config('app.image_allow_upload'),
    		],$validasi);

    		$message = array_merge([
    			'image2.image' => 'Gambar 2 tidak valid',
           		'image2.dimensions' => 'Gambar 2 dimensi tidak valid',
           		'image2.max' => 'Gambar 2 max size tidak valid',
           		'image2.mimes' => 'Gambar 2 tidak valid'
    		],$message);
    	}

    	if($request->hasFile('image3')){
    		$validasi = array_merge([
           		'image3' => "image|dimensions:max_width=".config('app.image_max_dim').",max_height=".config('app.image_max_dim')."|max:".config('app.image_max_upload')."|mimes:".config('app.image_allow_upload'),
    		],$validasi);

    		$message = array_merge([
    			'image3.image' => 'Gambar 3 tidak valid',
           		'image3.dimensions' => 'Gambar 3 dimensi tidak valid',
           		'image3.max' => 'Gambar 3 max size tidak valid',
           		'image3.mimes' => 'Gambar 3 tidak valid'
    		],$message);
    	}

    	$validator = \Validator::make($request->all(),$validasi,$message);

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

        if(!Category::where('id',$request->category_id)->first()){
        	return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Kategori tidak ditemukan"
                ]
            ]);
        }

        $product = Product::where('id',$request->id)->first();

        if(!$product){
        	return redirect()
        	->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => 'Data id tidak ditemukan'
                ]
            ]);
        }

        $payload = $request->only('name','category_id','description','condition','fine','question');
        $payload['rent_price'] = intval(str_replace(".", "", $request->rent_price));

        $oldImages = [];
        $newImages = [];
        $theNewImages = [];

        if($request->hasFile('image1')){
        	$newFileName = $this->uploadImage($request->file('image1'));
        	array_push($oldImages,$product->get_images[0]);
        	array_push($newImages,$newFileName);
        	array_push($theNewImages,$newFileName);
        }else{        	
        	array_push($newImages,$product->get_images[0]);
        }

        if($request->hasFile('image2')){
        	$newFileName = $this->uploadImage($request->file('image2'));

            if(isset($product->get_images[1])){
    			array_push($oldImages,$product->get_images[1]);
            }

			array_push($newImages,$newFileName);
        	array_push($theNewImages,$newFileName);
        }else{
            if(isset($product->get_images[1])){
        	   array_push($newImages,$product->get_images[1]);
            }
        }

        if($request->hasFile('image3')){
        	$newFileName = $this->uploadImage($request->file('image3'));

            if(isset($product->get_images[2])){
        	   array_push($oldImages,$product->get_images[2]);
            }
        	array_push($newImages,$newFileName);
        	array_push($theNewImages,$newFileName);
        }else{
            if(isset($product->get_images[2])){
        	   array_push($newImages,$product->get_images[2]);
            }
        }

        $payload['images'] = json_encode($newImages);

        if($product->update($payload)){
        	// DELETE OLD IMAGES

			foreach($oldImages as $item){
		        $path = public_path().config('app.folder_products')."".$item;

            	if(file_exists($path)){            
		            unlink($path);     
            	}        		
			}	        	

			return redirect()
        	->back()
            ->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => 'Berhasil Update Data'
                ]
            ]);
        }

        // DELETE NEW IMAGES
		foreach($theNewImages as $item){
		    $path = public_path().config('app.folder_products')."".$item;

           	if(file_exists($path)){            
		        unlink($path);     
            }        		
		}	   

		return redirect()
        	->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => 'Gagal Update Data'
                ]
            ]);
    }

    function addProduct(Request $request){
        $category = Category::all();

        return view("admin.product-create",compact('category'));
    }

    function add(Request $request){
        $validasi = [
            "name" => "required",
            "rent_price" => "required",
            "category_id" => "required|integer",
            "description" => "required",
            "condition" => "required",
            "fine" => "required",
            "question" => "required",
            'image1' => "required|image|dimensions:max_width=".config('app.image_max_dim').",max_height=".config('app.image_max_dim')."|max:".config('app.image_max_upload')."|mimes:".config('app.image_allow_upload'),
        ];

        $message = [            
            "name.required" => "Nama harus diisi",
            "rent_price.required" => "Harga sewa harus diisi",
            "category_id" => "Kategori harus diisi",
            "category_id.integer" => "Kategori tidak valid",
            "description.required" => "Deskripsi harus diisi",
            "condition.required" => "Syarat dan ketentuan harus diisi",
            "fine.required" => "Denda harus diisi",
            "question.required" => "Pertanyaan harus diisi",
            'image1.required' => 'Gambar 1 harus diisi',
            'image1.image' => 'Gambar 1 tidak valid',
            'image1.dimensions' => 'Gambar 1 dimensi tidak valid',
            'image1.max' => 'Gambar 1 max size tidak valid',
            'image1.mimes' => 'Gambar 1 tidak valid'
        ];

        if($request->hasFile('image2')){
            $validasi = array_merge([
                'image2' => "image|dimensions:max_width=".config('app.image_max_dim').",max_height=".config('app.image_max_dim')."|max:".config('app.image_max_upload')."|mimes:".config('app.image_allow_upload'),
            ],$validasi);

            $message = array_merge([
                'image2.image' => 'Gambar 2 tidak valid',
                'image2.dimensions' => 'Gambar 2 dimensi tidak valid',
                'image2.max' => 'Gambar 2 max size tidak valid',
                'image2.mimes' => 'Gambar 2 tidak valid'
            ],$message);
        }

        if($request->hasFile('image3')){
            $validasi = array_merge([
                'image3' => "image|dimensions:max_width=".config('app.image_max_dim').",max_height=".config('app.image_max_dim')."|max:".config('app.image_max_upload')."|mimes:".config('app.image_allow_upload'),
            ],$validasi);

            $message = array_merge([
                'image3.image' => 'Gambar 3 tidak valid',
                'image3.dimensions' => 'Gambar 3 dimensi tidak valid',
                'image3.max' => 'Gambar 3 max size tidak valid',
                'image3.mimes' => 'Gambar 3 tidak valid'
            ],$message);
        }

        $validator = \Validator::make($request->all(),$validasi,$message);

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

        if(!Category::where('id',$request->category_id)->first()){
            return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Kategori tidak ditemukan"
                ]
            ]);
        }    

        $payload = $request->only('name','category_id','description','condition','fine','question');
        $payload['rent_price'] = intval(str_replace(".", "", $request->rent_price));
        $payload['status'] = 'aktif';

        $images = [];

        array_push($images,$this->uploadImage($request->file('image1')));

        if($request->hasFile('image2')){        
            array_push($images,$this->uploadImage($request->file('image2')));
        }

        if($request->hasFile('image3')){        
            array_push($images,$this->uploadImage($request->file('image3')));
        }

        $payload['images'] = json_encode($images);

        if(Product::create($payload)){
            return redirect()
            ->back()
            ->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => 'Berhasil Tambah Data'
                ]
            ]);
        }

        // DELETE IMAGES
        foreach($images as $item){
            $path = public_path().config('app.folder_products')."".$item;

            if(file_exists($path)){            
                unlink($path);     
            }               
        }      

        return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => 'Gagal Tambah Data'
                ]
            ]);
    }

    function uploadImage($image){
 		$extension = $image->getClientOriginalExtension();
        $fileName = Str::random("20").'.' . $extension;
        $filePath = public_path() . config("app.folder_products");
        $image->move($filePath,$filePath."".$fileName);        
        return $fileName;
    }
}
