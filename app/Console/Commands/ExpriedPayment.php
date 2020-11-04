<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\{
    Invoice,
    ManualPayment,
    OrderItem
};
use Carbon\Carbon,DB;

class ExpriedPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change Status Invoice To Expired Payment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
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
    }
}
