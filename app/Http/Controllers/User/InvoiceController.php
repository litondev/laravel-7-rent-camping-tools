<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
	OrderItem,
	Invoice,
    NotifAdmin,
    ManualPayment
};
use Auth,DB;

class InvoiceController extends Controller
{
    function index(Request $request){
    	$invoice = Invoice::where("user_id",Auth::user()->id)
        ->with(["order_items","order_items.product"])
        ->whereIn("status",[
            "pending","payment","prepare","withdrawing stuff","in rent","backing stuff"
        ])
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

    	return view("user.invoice",compact("invoice"));        	
    }

    function historyInvoice(Request $request){
    	$invoice = Invoice::where("user_id",Auth::user()->id)
        ->withCount("manual_payments")
    	->with(["manual_payments" => function($q){
            $q->orderBy("id","desc");
        },"order_items","order_items.product",])
        ->orderBy("id","desc")
    	->paginate(6);        

    	return view("user.history-invoice",compact("invoice"));
    }

    function cancelOrder(Request $request,$id){
    	try{
    		DB::beginTransaction();

    		if(!Invoice::where("id",$id)
                ->where("user_id",Auth::user()->id)
                ->whereIn("status",["pending","prepare","payment"])
                ->first()){
    			DB::rollback();

	    		return redirect()
                ->back()
                ->with([
                    "error" => [
                        "title" => "Terjadi Kesalahan",
                        "text" => "Invoice tidak valid"
                    ]
                ]);    
    		}

    		if(Invoice::where("id",$id)
                ->where("user_id",Auth::user()->id)
                ->whereIn("status",["pending","prepare","payment"])
                ->update([
	    		"status" => "canceled"
    		])){
                ManualPayment::where("status","validasi")
                ->where("invoice_id",$id)
                ->where("user_id",Auth::user()->id)
                ->update([
                    "status" => "failed",
                    "status_description" => "Pembatalan Order"
                ]);

	            $order_item = OrderItem::with("product")
                    ->where("invoice_id",$id)
                    ->where("user_id",Auth::user()->id)
                    ->where("status","invoice")
                    ->get();

	 			foreach ($order_item as $item) {
                	$item->product->update([
	                    "status_rent" => 0
                	]);
            	}

                NotifAdmin::create([
                    "content" => "User ".Auth::user()->first_name." telah mencancel orderan invoice id #".$id
                ]);

            	DB::commit();

            	return redirect("/history-invoice")
                ->with([
                    "success" => [
                        "title" => "Berhasil",
                        "text" => "Berhasil membatalkan pesanan"
                    ]
                ]);
    		}  

    		DB::rollback();

    		return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Maaf terjadi kesalahan"
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
                    "text" => "Maaf terjadi kesalahan"
                ]
            ]);
        }
    }

    function downloadPdfInvoice(Request $request,$id){
        $invoice = Invoice::where("id",$id)
        ->where("user_id",Auth::user()->id)        
        ->with("order_items","order_items.product")        
        ->first();

        if(!$invoice){
            return redirect()->back()->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Invoice sepertinya tidak valid"
                ]
            ]);
        }

        $pdf = \Pdf::loadView("pdf.invoice",["invoice" => $invoice]);

        return $pdf->download("invoice-#".$invoice->id.".pdf");
    }
}
