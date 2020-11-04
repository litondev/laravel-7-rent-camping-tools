<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB,Auth;
use Carbon\Carbon;
use App\Models\{
    Invoice,
    OrderItem,
    NotifAdmin
};

class CheckoutController extends Controller
{
     function checkout(Request $request){       
        try{
            DB::beginTransaction();

            // VALIDASI INVOICE
            if(Invoice::where("user_id",Auth::user()->id)
                ->whereIn("status",
                    ["pending","payment","prepare","withdrawing stuff","in rent","backing stuff"]
                )->first()){
                DB::rollback();

                return redirect()
                ->back()
                ->with([
                    "error" => [
                        "title" => "Terjadi Kesalahan",
                        "text" => "Maaf anda masih punya invoice yang aktif"
                    ]
                ]);
            }

            $dateRent = explode(" - ",$request->date_rent);

            // VALIDASI TGL RENTAL
            if(!is_array($dateRent)){
                DB::rollback();
                
                return redirect()
                ->back()
                ->with([
                    "error" => [
                        "title" => "Terjadi Kesalahan",
                        "text" => "Maaf spertinya tanggal tidak valid"
                    ]
                ]);
            }

            $startRent = $dateRent[0];
            $endRent = $dateRent[1];

            $guaranteing = $request->guaranteing;
       
            // VALIDASI TGL VALID 
            if(Carbon::parse($startRent)->isBefore(
                Carbon::now()->setTime(0, 0, 0)->addDays(intval(config('app.expired_invoice')))
            )){
                DB::rollback();

                return redirect()
                ->back()
                ->with([
                    "error" => [
                        "title" => "Terjadi Kesalahan",
                        "text" => "Maaf sepertinya tanggal anda tidak valid"
                    ]
                ]); 
            }

            // VALIDASI TGL VALID
            if(Carbon::parse($endRent)->isBefore(Carbon::parse($startRent))){
                DB::rollback();

                return redirect()
                ->back()
                ->with([
                    "error" => [
                        "title" => "Terjadi Kesalahan",
                        "text" => "Maaf sepertinya tanggal anda tidak valid"
                    ]
                ]);   
            }

            // VALIDASI MAX TGL RENTAL
            if(Carbon::parse($endRent)->isAfter(Carbon::parse($startRent)->addDays(config('app.max_rent_product')))){
                DB::rollback();

                return redirect()
                ->back()
                ->with([
                    "error" => [
                        "title" => "Terjadi Kesalahan",
                        "text" => "Max Sewa Adalah ".config('app.max_rent_product')." Hari"
                    ]
                ]);   
            }

            // VALIDASI MIN TGL RENTAL
            if(Carbon::parse($startRent)->addDays(config('app.min_rent_product'))->isAfter(Carbon::parse($endRent))){
                DB::rollback();

                return redirect()
                ->back()
                ->with([
                    "error" => [
                        "title" => "Terjadi Kesalahan",
                        "text" => "Min Sewa Adalah ".config('app.min_rent_product')." Hari"
                    ]
                ]);   
            }

            $total = 0;

            $order_item = OrderItem::with("product")
                ->where("user_id",Auth::user()->id)
                ->where("status","cart")
                ->get();

            foreach ($order_item as $item) {
                // JIKA PRODUCT YANG DI CART TELAH TERSEWA OLEH ORANG LAIN
                if(intval($item->product->status_rent) == 1){
                    DB::rollback();

                    return redirect()
                    ->back()
                    ->with([
                        "error" => [
                            "title" => "Terjadi Kesalahan",
                            "text" => "Product ".$item->product->name." telah tersewa"
                        ]
                    ]);
                }

                $item->product->update([
                    "status_rent" => 1
                ]);

                $total += $item->product->rent_price;
            }   

            $date_expired_payment =  Carbon::now()
            ->addDays((intval(config('app.expired_invoice'))-1))
            ->toDateTimeString();

            $invoice = Invoice::create([
                "user_id" => Auth::user()->id,
                "start_rent" => $startRent,
                "end_rent" => $endRent,
                "expired_payment" => $date_expired_payment,
                "total" => $total,
                "guaranteing" => $guaranteing         
            ]);

            OrderItem::where("user_id",Auth::user()->id)
            ->where("status","cart")
            ->update([
                "invoice_id" => $invoice->id,
                "status" => "invoice"
            ]);

            NotifAdmin::create([
                "content" => "User ".Auth::user()->first_name." telah melakukan checkout invoice id #".$invoice->id
            ]);

            DB::commit();

            return redirect("/invoice")
            ->with([
                "success" => [
                    "title" => "Berhasil",
                    "text" => "Tunggu divalidasi admin"
                ]
            ]);
        }catch(\Exception $e){
            DB::rollback();
            
            \Log::error($e);

            return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Maaf Terjadi Kesalahan"
                ]
            ]);
        }
    }
}
