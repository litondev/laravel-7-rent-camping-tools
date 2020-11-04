<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    ManualPayment,
    Invoice,
    Notif
};
use DB;

class ManualPaymentController extends Controller
{
    function index(Request $request){
        $manualPayment = new ManualPayment();

        $manualPayment = $manualPayment->with(["invoice","user"]);

        if($request->has('form_id') && $request->has('to_id') && !empty($request->form_id) && !empty($request->has('to_id'))){
            $manualPayment = $manualPayment->whereBetween("id",[$request->form_id,$request->to_id]);
        }

        if($request->has('first_name') && !empty($request->first_name)){
            $search = $request->first_name;
            
            $manualPayment = $manualPayment->whereHas("user",function($q) use ($search){
                $q->where('first_name','like','%'.$search.'%');
            });
        }

        if($request->has('invoice_id') && !empty($request->invoice_id)){
            $manualPayment = $manualPayment->where('invoice_id',$request->invoice_id);
        } 

        if($request->has('status') && !empty($request->status)){
            $manualPayment = $manualPayment->where('status',$request->status);
        }

        if($request->has('search_created_at') && !empty($request->search_created_at)){
            $dateCreated = explode(" - ",$request->search_created_at);
        
            if(is_array($dateCreated)){              
                $startDate = $dateCreated[0];
                $endDate = $dateCreated[1];

                $manualPayment = $manualPayment->whereBetween("created_at",[$startDate,$endDate]);
            }
        }

        $manualPayment = $manualPayment->orderBy('id','desc')->paginate(10);

        return view("admin.manual-payment",compact('manualPayment','request'));
    }

    function validasiManualPayment(Request $request){
        $manualPayment = new ManualPayment();

        $manualPayment = $manualPayment->with(["invoice","user"]);

        if($request->has('form_id') && $request->has('to_id') && !empty($request->form_id) && !empty($request->has('to_id'))){
            $manualPayment = $manualPayment->whereBetween("id",[$request->form_id,$request->to_id]);
        }

        if($request->has('first_name') && !empty($request->first_name)){
            $search = $request->first_name;
            
            $manualPayment = $manualPayment->whereHas("user",function($q) use ($search){
                $q->where('first_name','like','%'.$search.'%');
            });
        }

        if($request->has('invoice_id') && !empty($request->invoice_id)){
            $manualPayment = $manualPayment->where('invoice_id',$request->invoice_id);
        } 

        if($request->has('search_created_at') && !empty($request->search_created_at)){
            $dateCreated = explode(" - ",$request->search_created_at);
        
            if(is_array($dateCreated)){              
                $startDate = $dateCreated[0];
                $endDate = $dateCreated[1];

                $manualPayment = $manualPayment->whereBetween("created_at",[$startDate,$endDate]);
            }
        }

        $manualPayment = $manualPayment->where("status","validasi")
        ->orderBy('id','desc')->paginate(10);

        return view("admin.manual-payment-validasi",compact('manualPayment','request'));
    }

    function detailManualPayment(Request $request,$id){
        $manualPayment = ManualPayment::with(["invoice.manual_payments" => function($q){
            $q->orderBy("id","desc");
        },"invoice","user"])->where('id',$id)->first();

        if(!$manualPayment){
            return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Data Pembayaran Manual Tidak Valid"
                ]
            ]);
        }

        // APAKAH ADA PEMBAYARAN MANUAL YANG STATUSNYA VALIDASI
        $isThreeValidasi = ManualPayment::where('invoice_id',$manualPayment->invoice_id)
        ->where('status','validasi')
        ->count();

        return view("admin.manual-payment-detail",compact("manualPayment","isThreeValidasi"));
    }

    // MENANDAI STATUS PEMBAYARAN MENJADI BERHASIL
    function successManualPayment(Request $request,$id){
        try{
            DB::beginTransaction();

            $manualPayment = ManualPayment::with('invoice')
            ->where('id',$id)
            ->where('status','validasi')
            ->whereHas('invoice',function($q){
                $q->where('status_payment','unpaid')
                ->where('status','payment');
            })
            ->first();

            if(!$manualPayment){
                DB::rollback();

                return redirect()
                ->back()
                ->with([
                    "error" => [
                        "title" => "Terjadi Kesalahan",
                        "text" => "Data Pembayaran Manual Tidak Valid"
                    ]
                ]);
            }

            if($manualPayment->update([
                "status" => "success"
            ])){
                // EMAIL

                // NOTIF
                Notif::create([
                    "user_id" => $manualPayment->user_id,
                    "title" => "Pembayaran #".$manualPayment->id,
                    "sub_title" => "Pembayaran berhasil",
                    "description" => "Pembayaran #".$manualPayment->id." telah berhasil divalidasi admin untuk invoice #".$manualPayment->invoice_id
                ]);

                DB::commit();

                return redirect()
                ->back()
                ->with([
                    "success" => [
                        "title" => "Berhasil",
                        "text" => "Berhasil Mengubah Data"
                    ]
                ]);
            }

            DB::rollback();

            return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Gagal Mengubah Data"
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
                    "text" => "Gagal Mengubah Data"
                ]
            ]);
        }
    }

    // MENANDAI STATUS PEMBAYARAN MENJADI GAGAL
    function failedManualPayment(Request $request,$id){
        try{
            DB::beginTransaction();

        	$manualPayment = ManualPayment::with('invoice')
            ->where('id',$id)
            ->where('status','validasi')
            ->whereHas('invoice',function($q){
                $q->where('status_payment','unpaid')
                ->where('status','payment');
            })
            ->first();

            if(!$manualPayment){
                DB::rollback();

                return redirect()
                ->back()
                ->with([
                    "error" => [
                        "title" => "Terjadi Kesalahan",
                        "text" => "Data Pembayaran Manual Tidak Valid"
                    ]
                ]);
            }

            if($manualPayment->update([
                "status" => "failed",
                "status_description" => $request->status_description
            ])){
                // EMAIL

                // NOTIF
                Notif::create([
                    "user_id" => $manualPayment->user_id,
                    "title" => "Pembayaran #".$manualPayment->id,
                    "sub_title" => "Pembayaran gagal",
                    "description" => "Pembayaran #".$manualPayment->id." telah gagal divalidasi oleh admin dengan alasan : ".$request->status_description." untuk invoice #".$manualPayment->invoice_id
                ]);

                DB::commit();

                return redirect()
                ->back()
                ->with([
                    "success" => [
                        "title" => "Berhasil",
                        "text" => "Berhasil Mengubah Data"
                    ]
                ]);
            }

            DB::rollback();

            return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Gagal Mengubah Data"
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
                    "text" => "Gagal Mengubah Data"
                ]
            ]);
        }
    }

    // MENANDAI STATUS PEMBAYARAN INVOICE BERHASIL DAN MERUBAH STATUS MENJADI PERSIAPAN
    function paidInvoice(Request $request,$id){
        try{
            DB::beginTransaction();

            $invoice = Invoice::where('id',$id)
                ->where('status','payment')
                ->where('status_payment','unpaid')
                ->first();

            if(!$invoice){
                DB::rollback();

                return redirect()
                ->back()
                ->with([
                    "error" => [
                        "title" => "Terjadi Kesalahan",
                        "text" => "Data Invoice Tidak Valid"
                    ]
                ]);
            }

            $isThreeValidasi = ManualPayment::where('invoice_id',$id)
            ->where('status','validasi')
            ->count();

            if($isThreeValidasi != 0){
                DB::rollback();

                return redirect()
                ->back()
                ->with([
                    "error" => [
                        "title" => "Terjadi Kesalahan",
                        "text" => "Data Invoice Tidak Valid"
                    ]
                ]);
            }

            if($invoice->update([
                "status" => "prepare",
                "status_payment" => "paid"
            ])){
                // EMAIL
                
                // NOTIF
                Notif::create([
                    "user_id" => $invoice->user_id,
                    "title" => "Invoice #".$invoice->id,
                    "sub_title" => "Status telah berubah",
                    "description" => "Pembayaran berhasil untuk invoice #".$invoice->id." status telah berubah menjadi persiapan"
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
                    "text" => "Gagal Mengubah Data"
                ]
            ]);
        }
    }
}