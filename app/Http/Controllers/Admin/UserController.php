<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    function index(Request $request){
    	$user = new User();

    	if($request->has('form_id') && $request->has('to_id') && !empty($request->form_id) && !empty($request->has('to_id'))){
    		$user = $user->whereBetween("id",[$request->form_id,$request->to_id]);
    	}

    	if($request->has('status') && !empty($request->status)){
    		$user = $user->where('status',$request->status);
    	}

    	if($request->has('first_name') && !empty($request->first_name)){
		 	$user = $user->where('first_name','like','%'.$request->first_name.'%');
		}

		if($request->has('last_name') && !empty($request->last_name)){
			$user = $user->where('last_name','like','%'.$request->last_name.'%');
		}

		if($request->has('email') && !empty($request->email)){
			$user = $user->where('email','like','%'.$request->email.'%');
		}

		if($request->has('role') && !empty($request->role)){
			$user = $user->where('role',$request->role);
		}

		if($request->has('gender') && !empty($request->gender)){
			$user = $user->where('gender',$request->gender);
		}

		if($request->has('phone') && !empty($request->phone)){
			$user = $user->where('phone',$request->phone);
		}

    	if($request->has('search_created_at') && !empty($request->search_created_at)){
    		$dateCreated = explode(" - ",$request->search_created_at);
        
            if(is_array($dateCreated)){              
            	$startDate = $dateCreated[0];
            	$endDate = $dateCreated[1];

            	$user = $user->whereBetween("created_at",[$startDate,$endDate]);
            }
    	}

    	$user = $user->orderBy($request->column ?? 'id',$request->order_by ?? 'desc')
    	->paginate($request->per_page ?? 10);

    	return view("admin.user",compact('user','request'));
    }

    function editUser(Request $request,$id){
    	$user = User::where('id',$id)->where('role','user')->first();

    	if(!$user){
    		return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => 'Maaf sepertinya ada data yang tidak valid'
                ]
            ]);
    	}

    	return view("admin.user-edit",compact("user"));
    }

    function userBlokir(Request $request){
    	$user = new User();

    	if($request->has('form_id') && $request->has('to_id') && !empty($request->form_id) && !empty($request->has('to_id'))){
    		$user = $user->whereBetween("id",[$request->form_id,$request->to_id]);
    	}    

    	if($request->has('first_name') && !empty($request->first_name)){
		 	$user = $user->where('first_name','like','%'.$request->first_name.'%');
		}

		if($request->has('last_name') && !empty($request->last_name)){
			$user = $user->where('last_name','like','%'.$request->last_name.'%');
		}

		if($request->has('email') && !empty($request->email)){
			$user = $user->where('email','like','%'.$request->email.'%');
		}

		if($request->has('gender') && !empty($request->gender)){
			$user = $user->where('gender',$request->gender);
		}

		if($request->has('phone') && !empty($request->phone)){
			$user = $user->where('phone',$request->phone);
		}

    	if($request->has('search_created_at') && !empty($request->search_created_at)){
    		$dateCreated = explode(" - ",$request->search_created_at);
        
            if(is_array($dateCreated)){              
            	$startDate = $dateCreated[0];
            	$endDate = $dateCreated[1];

            	$user = $user->whereBetween("created_at",[$startDate,$endDate]);
            }
    	}

    	$user = $user->where('status','blokir')
    	->orderBy($request->column ?? 'id',$request->order_by ?? 'desc')
    	->paginate($request->per_page ?? 10);

    	return view("admin.user-blokir",compact('user','request'));
    }

    function blokir(Request $request){
    	$validator = \Validator::make($request->all(), [           
           'id' => 'required|integer',
           'description_blokir' => 'required'
        ],[
           'id.required' => 'Id harus diisi',
           'id.integer' => 'Id tidak valid',
           'description_blokir.required' => 'Deskripsi harus diisi'
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

		$user = User::where('id',$request->id)->where('status','aktif')->first();

        if(!$user){
        	return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => 'Maaf sepertinya ada data yang tidak valid'
                ]
            ]);
        }

        if($user->update([
        	"status" => "blokir",
        	"description_blokir" => $request->description_blokir
        ])){
            // EMAIL        
            
        	return redirect("admins/user/blokir?form_id=".$user->id."&to_id=".$user->id)
            ->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => 'Berhasil blokir user'
                ]
            ]);
        }

     	return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => 'Gagal blokir user'
                ]
            ]);
    }

    function unblokir(Request $request,$id){
		$user = User::where('id',$request->id)->where('status','blokir')->first();

		if(!$user){
			return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => 'Maaf sepertinya ada data yang tidak valid'
                ]
            ]);
		}
		
		if($user->update([
        	"status" => "aktif",
        	"description_blokir" => Null
        ])){
            // EMAIL

        	return redirect("admins/user?form_id=".$user->id."&to_id=".$user->id)
            ->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => 'Berhasil unblokir user'
                ]
            ]);
        }

     	return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => 'Gagal unblokir user'
                ]
            ]);		
    }

    function edit(Request $request,$id){
    	$validasi = [
    		'id' => 'required|integer',
    		'first_name' => 'required',
    		'last_name' => 'required',
    		'phone' => 'required',
    		'address' => 'required',
    		'email' => 'required|email|unique:users,email,'.$request->id,
    		'role' => 'required'
    	];

    	$message = [
    		'id.required' => 'Id harus diisi',
    		'id.integer' => 'Id tidak valid',
	    	'first_name.required' => 'Nama Depan harus diisi',
        	'last_name.required' => 'Nama Belakang harus diisi',
        	'phone.required' => 'No Telp harus diisi',
        	'address.required' => 'Alamat harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email'  => 'Format email tidak sesuai',
            'email.unique' => "Email telah terpakai",
            'role.required' => 'Role harus diisi'
    	];

    	if($request->has('password') && !empty($request->password)){
    		$validasi = array_merge([
    			'password' => 'required|min:8'
    		],$validasi);

    		$message = array_merge([        
            	'password.required'  => 'Password harus diisi',
            	'password.min'  => 'Password harus :min karakter',
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

        if(!User::where('id',$request->id)->first()){
        	return redirect()
        	->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => 'Data id tidak ditemukan'
                ]
            ]);
        }	

        $payload = $request->only("first_name","last_name","phone","address",'email','role');

 		// CEK PHONE VALID
        $mobile_phone = preg_replace('/[^0-9\+]/','',strval($payload['phone']));
        if(substr($mobile_phone, 0,2) != '08'){
           return redirect()
           ->back()
           ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "No telp harus 08"
                ]
            ]);
        }
        $validPhone = substr($mobile_phone, 0,2);
        $noBelakang = explode($validPhone,$mobile_phone)[1];
        $payload['phone'] = $validPhone . preg_replace('/[^0-9]/','',strval($noBelakang));                                        

        // CEK PHONE UNIQUE
        if(User::where('phone',intval($payload['phone']))
            ->whereNotIn("id",[$request->id])
            ->first()){
           return redirect()
       	    ->back()
           ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "No telp telah terpakai"
                ]
            ]);
        }

        if($request->has('password') && !empty($request->password)){
        	$payload['password'] = \Hash::make($request->password);
        }
       
        if(User::where('id',$request->id)->update($payload)){
        	if($request->role == 'admin'){
				return redirect("admins/user")
            	->with([
	                "success" => [
                    	"title" => "Berhasil",
                    	"text" => "Berhasil update data"
                	]
            	]);
        	}else{
        		return redirect()
        		->back()
            	->with([
	                "success" => [
                    	"title" => "Berhasil",
                    	"text" => "Berhasil update data"
                	]
            	]);
            }
        }

        return redirect()
        ->back()
        ->with([
            "error" => [
                "title" => "Terjadi Kesalahan",
                "text" => "Gagal update data"
            ]
        ]);
    }
}
