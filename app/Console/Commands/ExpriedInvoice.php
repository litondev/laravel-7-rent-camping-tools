<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\{
    Invoice,
    Product
};
use Carbon\Carbon;

class ExpriedInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired:invoice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change Status Invoice To Expired Invoice';

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
        Invoice::where("status","backing stuff")
        ->where("status_payment","paid")
        ->where("end_rent","<",Carbon::now()->addDays(-1)->toDateTimeString())
        ->update([
            "status" => "expired invoice"
        ]);
    }
}
