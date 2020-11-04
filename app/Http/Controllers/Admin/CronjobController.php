<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Invoice,
    ManualPayment,
    OrderItem
};
use Carbon\Carbon,DB;

class CronjobController extends Controller
{
    function index(Request $request){
    	return view("admin.cronjob");
    }

    function actionBackingStuff(){    	
    	Invoice::where("status","in rent")
        ->where("status_payment","paid")
        ->where("end_rent","<",Carbon::now()->toDateTimeString())
        ->update([
            "status" => "backing stuff"
        ]);

    	return redirect()->back()->with(["success" => ["title" => "Berhasil","text" => "success"]]);
    }

    function actionExpiredInvoice(){
    	Invoice::where("status","backing stuff")
        ->where("status_payment","paid")
        ->where("end_rent","<",Carbon::now()->addDays(-1)->toDateTimeString())
        ->update([
            "status" => "expired invoice"
        ]);

        return redirect()->back()->with(["success" => ["title" => "Berhasil","text" => "success"]]);
    }

    function actionExpiredPayment(){
    	$invoice = Invoice::where('status','payment')
            ->where('status_payment','unpaid')
            ->where("expired_payment","<",Carbon::now()->toDateTimeString())
            ->take(300)
            ->get();
        
        foreach ($invoice as $itemInvoice) {
            try{
                DB::beginTransaction();

                $itemInvoice->update([
                    "status" => "expired payment",
                    "status_payment" => "expired"
                ]);

                $orderItem = OrderItem::with("product")
                    ->where("invoice_id",$itemInvoice->id)
                    ->get();

                foreach ($orderItem as $itemOrderItem) {
                    $itemOrderItem->product->update([
                        "status_rent" => 0
                    ]);
                }

                ManualPayment::where("invoice_id",$itemInvoice->id)
                ->where("status","validasi")
                ->update([
                    "status" => "failed",
                    "status_description" => "Kadaluarsa Pembayaran"
                ]);

                DB::commit();
            }catch(\Exception $e){
                DB::rollback();

                \Log::info($e);
            }
        }

        return redirect()->back()->with(["success" => ["title" => "Berhasil","text" => "success"]]);
    }
}
