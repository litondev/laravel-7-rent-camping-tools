<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
	ManualPayment,
	Invoice,
    NotifAdmin
};
use Illuminate\Support\Str;
use Auth,DB;

class ManualPaymentController extends Controller
{
    function index(Request $request){
    	$historyManualPayment = ManualPayment::where("user_id",Auth::user()->id)
    	->orderBy('id','desc')
    	->paginate(6);

    	return view("user.history-manual-payment",compact("historyManualPayment"));
    }

    function formManualPayment(Request $request){
        $invoice = Invoice::where("user_id",Auth::user()->id)
        ->with(["order_items","order_items.product","manual_payments"])
        ->whereIn("status",[
            "payment"
        ])
        ->where("status_payment","unpaid")
        ->first();

        if(!$invoice){
            return redirect("/akun")        
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Maaf sepertinya anda tidak mempunyai invoice aktif sekarang"
                ]
            ]);
        }
    
        return view("user.manual-payment",compact("invoice"));
    }

 	function manualPayment(Request $request){         
    	$validator = \Validator::make($request->all(), [
           'description' => 'required',
           'proof' => "required|image|dimensions:max_width=".config('app.image_max_dim').",max_height=".config('app.image_max_dim')."|max:".config('app.image_max_upload')."|mimes:".config('app.image_allow_upload'),
        ],[
           'description.required' => 'Keterangan harus diisi',
           'proof.required' => 'Bukti harus diisi',
           'proof.image' => 'Bukti tidak valid',
           'proof.dimensions' => 'Bukti dimensi tidak valid',
           'proof.max' => 'Bukti max size tidak valid',
           'proof.mimes' => 'Bukti tidak valid'
        ]);

        // VALIDASI DATA
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

        try{
            DB::beginTransaction();

            if(Invoice::where("user_id",Auth::user()->id)
                ->where("status","payment")
                ->orderBy("id","desc")
                ->first()){
                $nameFile = $this->uploadImage($request->file("proof"));

            	if(ManualPayment::create([
            		"user_id" => Auth::user()->id,
            		"invoice_id" => Invoice::where("user_id",Auth::user()->id)
                        ->where("status","payment")
                        ->orderBy("id","desc")
                        ->first()
                        ->id,
            		"proof" => $nameFile,
            		"description" => $request->description,
            		"status" => "validasi",    		
            	])){
                    NotifAdmin::create([
                        "content" => "User ".Auth::user()->first_name." telah mengirim bukti pembayaran"
                    ]);

                    DB::commit();

        			return redirect("/history-manual-payment") 
                    ->with([
                        "success" => [
                            "title" => "Berhasil",
                            "text" => "Berhasil mengirim pembayaran manual,tunggu diproses admin"
                        ]
                    ]);
            	}
            }

            DB::rollback();

    		return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Gagal mengirim pembayaran manual"
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
                    "text" => "Gagal mengirim pembayaran manual"
                ]
            ]);
        }
    }

    function uploadImage($image){
 		$extension = $image->getClientOriginalExtension();
        $fileName = Str::random("20").'.' . $extension;
        $filePath = public_path() . config("app.folder_proofs");
        $image->move($filePath,$filePath."".$fileName);        
        
        return $fileName;
    }
}
