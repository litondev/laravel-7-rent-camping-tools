<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
	Invoice,
    Notif,
    Product,
    OrderItem
};
use DB;

class InvoiceActionController extends Controller
{
    // MERUBAH STATUS INVOCE MENJADI DITOLAK
    function actionRejected(Request $request,$id){
        try{
            DB::beginTransaction();

            $invoice = Invoice::where('id',$id)
                ->where('status','pending')
                ->where('status_payment','unpaid')
                ->first();

            if($invoice->update([
                "status" => "rejected"
            ])){
                // EMAIL

                // CREATE NOTIF
                Notif::create([
                    "user_id" => $invoice->user_id,
                    "title" => "Invoice #".$invoice->id,
                    "sub_title" => "Status telah berubah",
                    "description" => "Invoice #".$invoice->id."  telah di tolak oleh admin dengan alasan : ".$request->reason
                ]);
        
                // UPDATE PRODUCT               
                $order_item = OrderItem::with("product")
                    ->where("invoice_id",$invoice->id)
                    ->get();

                foreach ($order_item as $item) {
                    $item->product->update([
                        "status_rent" => 0
                    ]);
                }


                DB::commit();

                return redirect()
                ->back()
                ->with([
                    "success" => [
                        "title" => "Berhasil",
                        "text" => "Berhasil Update Data"
                    ]
                ]);
            }

            DB::rollback();
            return redirect()
                ->back()
                ->with([
                    "error" => [
                        "title" => "Terjadi Kesalahan",
                        "text" => "Gagal Update Data"
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
                        "text" => "Gagal Update Data"
                    ]
                ]);
        }
    }

    // MERUBAH STATUS INVOICE MENJADI PEMBAYARAN
    function actionPayment(Request $request,$id){
        try{
            DB::beginTransaction();

            $invoice = Invoice::where('id',$id)
            ->where('status','pending')
            ->where('status_payment','unpaid')
            ->first();

            if($invoice->update([
                "status" => "payment"
            ])){
                // EMAIL

                // NOTIF
                Notif::create([
                    "user_id" => $invoice->user_id,
                    "title" => "Invoice #".$invoice->id,
                    "sub_title" => "Status telah berubah",
                    "description" => "Invoice #".$invoice->id." status telah berubah menjadi pembayaran"
                ]);

                DB::commit();

                return redirect()
                ->back()
                ->with([
                    "success" => [
                        "title" => "Berhasil",
                        "text" => "Berhasil Update Data"
                    ]
                ]);
            }

            DB::rollback();

            return redirect()
                ->back()
                ->with([
                    "error" => [
                        "title" => "Terjadi Kesalahan",
                        "text" => "Gagal Update Data"
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
                        "text" => "Gagal Update Data"
                    ]
                ]);
        }
    }

    // MERUBAH STATUS INVOICE MENJADI PENGAMBILAN BARANG
    function actionWithdrawingStuff(Request $request,$id){
        try{
            DB::beginTransaction();

            $invoice = Invoice::where('id',$id)
            ->where('status','prepare')
            ->where('status_payment','paid')
            ->first();

            if($invoice->update([
                "status" => "withdrawing stuff"
            ])){
                // EMAIL
                
                // NOTIF
                Notif::create([
                    "user_id" => $invoice->user_id,
                    "title" => "Invoice #".$invoice->id,
                    "sub_title" => "Status telah berubah",
                    "description" => "Invoice #".$invoice->id." status telah berubah menjadi pengambilan barang"
                ]);

                DB::commit();

                return redirect()
                ->back()
                ->with([
                    "success" => [
                        "title" => "Berhasil",
                        "text" => "Berhasil Update Data"
                    ]
                ]);
            }

            DB::rollback();

            return redirect()
                ->back()
                ->with([
                    "error" => [
                        "title" => "Terjadi Kesalahan",
                        "text" => "Gagal Update Data"
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
                    "text" => "Gagal Update Data"
                ]
            ]);
        }
    }

    // MERUBAH STATUS INVOICE MENJADI DALAM PENYEWAAN
    function actionInRent(Request $request,$id){
        try{
            DB::beginTransaction();

            $invoice = Invoice::where('id',$id)
            ->where('status','withdrawing stuff')
            ->where('status_payment','paid')
            ->first();

            if($invoice->update([
                "status" => "in rent"
            ])){
                // EMAIL

                // NOTIF
                Notif::create([
                    "user_id" => $invoice->user_id,
                    "title" => "Invoice #".$invoice->id,
                    "sub_title" => "Status telah berubah",
                    "description" => "Invoice #".$invoice->id." status telah berubah menjadi dalam penyewaan"
                ]);

                DB::commit();

                return redirect()
                ->back()
                ->with([
                    "success" => [
                        "title" => "Berhasil",
                        "text" => "Berhasil Update Data"
                    ]
                ]);
            }

            DB::rollback();

            return redirect()
                ->back()
                ->with([
                    "error" => [
                        "title" => "Terjadi Kesalahan",
                        "text" => "Gagal Update Data"
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
                    "text" => "Gagal Update Data"
                ]
            ]);
        }
    }

    // MERUBAH STATUS INVOICE MENJADI PENGEMBALIAN BARANG
    function actionBackingStuff(Request $request,$id){
        try{
            DB::beginTransaction();

            $invoice = Invoice::where('id',$id)
            ->where('status','in rent')
            ->where('status_payment','paid')
            ->first();

            if($invoice->update([
                "status" => "backing stuff"
            ])){
                // EMAIL
                
                // NOTIF
                Notif::create([
                    "user_id" => $invoice->user_id,
                    "title" => "Invoice #".$invoice->id,
                    "sub_title" => "Status telah berubah",
                    "description" => "Invoice #".$invoice->id." status telah berubah menjadi pengembalian barang"
                ]);

                DB::commit();

                return redirect()
                ->back()
                ->with([
                    "success" => [
                        "title" => "Berhasil",
                        "text" => "Berhasil Update Data"
                    ]
                ]);
            }

            DB::rollback();

            return redirect()
                ->back()
                ->with([
                    "error" => [
                        "title" => "Terjadi Kesalahan",
                        "text" => "Gagal Update Data"
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
                        "text" => "Gagal Update Data"
                    ]
                ]);
        }
    }

    // MERUBAH STATUS INVOICE MENJADI SELESAI
    function actionCompleted(Request $request,$id){
        try{
            DB::beginTransaction();

            $invoice = Invoice::where('id',$id)
            ->where('status','backing stuff')
            ->where('status_payment','paid')
            ->first();

            if($invoice->update([
                "status" => "completed"
            ])){
                // EMAIL
                
                // NOTIF
                Notif::create([
                    "user_id" => $invoice->user_id,
                    "title" => "Invoice #".$invoice->id,
                    "sub_title" => "Status telah berubah",
                    "description" => "Invoice #".$invoice->id." status telah berubah menjadi selesai"
                ]);

                // UPDATE PRODUCT
                $order_item = OrderItem::with("product")
                    ->where("invoice_id",$invoice->id)
                    ->get();

                foreach ($order_item as $item) {
                    $item->product->update([
                        "status_rent" => 0
                    ]);
                }

                DB::commit();

                return redirect()
                ->back()
                ->with([
                    "success" => [
                        "title" => "Berhasil",
                        "text" => "Berhasil Update Data"
                    ]
                ]);
            }

            DB::rollback();
            return redirect()
                ->back()
                ->with([
                    "error" => [
                        "title" => "Terjadi Kesalahan",
                        "text" => "Gagal Update Data"
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
                        "text" => "Gagal Update Data"
                    ]
                ]);
        }
    }

    // MENGEDIT DENDA
    function editFine(Request $request,$id){
        $validator = \Validator::make($request->all(), [           
           'fine_description' => 'required',
           'fine_total' => 'required',
        ],[
           'fine_description.required' => "Deskripsi denda harus diisi",
           "fine_total.required" => "Todal denda harus diisi"     
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

        $payload = $request->only("fine_description");        
        $payload["fine_total"] = intval(str_replace(".","",$request->fine_total));

        if(Invoice::where('id',$id)->update($payload)){
             return redirect()
                ->back()
                ->with([
                    "success" => [
                        "title" => "Berhasil",
                        "text" => "Berhasil Edit Denda"
                    ]
                ]);
        }

        return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Gagal Edit Denda"
                ]
            ]);
    }

    // MEMBERIKAN DENDA
    function addFine(Request $request){
        $validator = \Validator::make($request->all(), [           
           'id' => 'required|integer',
           'fine_description' => 'required',
           'fine_total' => 'required',
        ],[
           'fine_description.required' => "Deskripsi denda harus diisi",
           "fine_total.required" => "Todal denda harus diisi",
           "id.required" => "Id harus diisi",
           'id.integer' => "Id tidak valid"
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


        try{
            DB::beginTransaction();
                
            $payload = $request->only("fine_description");        
            $payload["fine_total"] = intval(str_replace(".","",$request->fine_total));
            $payload["is_fine"] = 1;

            $invoice = Invoice::where('id',$request->id)->first();

            if($invoice->update($payload)){
                // EMAIL

                // NOTIF 
                Notif::create([
                    "user_id" => $invoice->user_id,
                    "title" => "Invoice #".$invoice->id,
                    "sub_title" => "Denda keterlambatan",
                    "description" => "Invoice #".$invoice->id." telah terkena denda keterlambatan pengembalian barang sebesar : Rp ".number_format($payload["fine_total"],"2")
                ]);

                // UPDATE PRODUCT
                $order_item = OrderItem::with("product")
                    ->where("invoice_id",$invoice->id)
                    ->get();

                foreach ($order_item as $item) {
                    $item->product->update([
                        "status_rent" => 0
                    ]);
                }

                DB::commit();

                return redirect()
                    ->back()
                    ->with([
                        "success" => [
                            "title" => "Berhasil",
                            "text" => "Berhasil Memberikan Denda"
                        ]
                    ]);
            }

            DB::rollback();

            return redirect()
                ->back()
                ->with([
                    "error" => [
                        "title" => "Terjadi Kesalahan",
                        "text" => "Gagal Memberikan Denda"
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
                        "text" => "Gagal Memberikan Denda"
                    ]
                ]);
        }
    }
}
