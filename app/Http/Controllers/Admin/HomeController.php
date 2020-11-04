<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
	Invoice,
	ManualPayment,
	User,
	Product,
};
use Carbon\Carbon,DB;

class HomeController extends Controller
{
    function index(Request $request){
	    $now = date("Y-m-d");
    	$label_sales = [];
    	$total_sales = [];
	    $total_value_sales = [];	  	    
	    
	    $gap = $request->has('gap') ? $request->gap : 7;

	    for($i=0;$i<intval($gap);$i++){    
	       array_push($label_sales,Carbon::createFromFormat("Y-m-d",$now)
	       	->subDays($i)
	       	->format("d M"));

	       $time_1 = Carbon::createFromFormat("Y-m-d",$now)
	       ->subDays($i)
	       ->toDateTimeString();
	       $time_1 = explode(" ",$time_1)[0]." 00:00:00";
	    
	       $time_2 = Carbon::createFromFormat("Y-m-d",$now)
	       ->subDays($i)
	       ->toDateTimeString();
	       $time_2 = explode(" ",$time_2)[0]." 23:59:59"; 

	       $data1 = Invoice::select(
	         DB::raw("count(*) as total"),
	         DB::raw("sum(total) as total_val")
	        )
	       ->whereBetween("created_at",[$time_1,$time_2])	       
	       ->where("status","completed")
	       ->first();

	        if(empty($data1["total_val"])){
	          $data1["total_val"] = 0;
	        }
	      	
	       	array_push($total_sales,$data1["total"]);       
	       	array_push($total_value_sales,$data1["total_val"]);
	    }

    	$data = (object) [
    		"invoice" => Invoice::orderBy('id','desc')->take(5)->get(),
    		"manualPayment" => ManualPayment::orderBy('id','desc')->take(5)->get(),
    		"label_sales" => $label_sales,
    		"total_sales" => $total_sales,
    		"total_value_sales" => $total_value_sales,
    		"user" => (object) [
    			"total" => User::count(),
    			"blokir" => User::where("status","blokir")->count(),
    			"aktif" => User::where("status","aktif")->count(),
    			"new" => User::whereBetween("created_at",[Carbon::now()->setTime(0,0,0)->subDays(7)->toDateTimeString(),Carbon::now()->setTime(0,0,0)->toDateTimeString()])->count()
    		],
    		"widget" => (object) [
    			"total_invoice" => Invoice::count(),
    			"total_product" => Product::count(),
    			"total_manual_payment" => ManualPayment::count(),
    			"total_value_invoice" => intval(Invoice::select(DB::raw('sum(total) as total'))->where('status','completed')->first()->total)
    		]
    	];

    	return view("admin.index",compact("data",'request'));
    }
}
