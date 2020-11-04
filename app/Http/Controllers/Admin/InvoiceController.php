<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
	Invoice
};

class InvoiceController extends Controller
{
    function index(Request $request){
    	$invoice = new Invoice();

    	$invoice = $invoice->with(["user"]);
    	
    	if($request->has('first_name') && !empty($request->first_name)){
    		$search = $request->first_name;

    		$invoice = $invoice->whereHas('user',function($q) use ($search){
    			$q->where('first_name','like','%'.$search.'%');
    		});
    	}

    	if($request->has('form_id') && $request->has('to_id') && !empty($request->form_id) && !empty($request->has('to_id'))){
    		$invoice = $invoice->whereBetween("id",[$request->form_id,$request->to_id]);
    	}
    
    	if($request->has('status') && !empty($request->status)){
    		$invoice = $invoice->where('status',$request->status);
    	}

    	if($request->has('status_payment') && !empty($request->status_payment)){
    		$invoice = $invoice->where('status_payment',$request->status_payment);
    	}

    	if($request->has('total') && !empty($request->total)){
    		$invoice = $invoice->where("total",$request->total);
    	}

    	if($request->has('search_created_at') && !empty($request->search_created_at)){
    		$dateCreated = explode(" - ",$request->search_created_at);
        
            if(is_array($dateCreated)){              
            	$startDate = $dateCreated[0];
            	$endDate = $dateCreated[1];

            	$invoice = $invoice->whereBetween("created_at",[$startDate,$endDate]);
            }
    	}

    	$invoice = $invoice->orderBy('id','desc')->paginate(10);

    	return view("admin.invoice",compact('invoice','request'));
    }

    function pending(Request $request){
        $invoice = new Invoice();

        $invoice = $this->search_same($invoice,$request);

        $invoice = $invoice->where('status','pending')
            ->orderBy('id','desc')
            ->paginate(10);

        return view("admin.invoice-pending",compact('invoice','request'));
    }

    function rejected(Request $request){
        $invoice = new Invoice();

        $invoice = $this->search_same($invoice,$request);

        $invoice = $invoice->where('status','rejected')
            ->orderBy('id','desc')
            ->paginate(10);

        return view("admin.invoice-rejected",compact('invoice','request'));
    }

    function completed(Request $request){
        $invoice = new Invoice();

        $invoice = $this->search_same($invoice,$request);

        $invoice = $invoice->where('status','completed')
            ->orderBy('id','desc')
            ->paginate(10);

        return view("admin.invoice-completed",compact('invoice','request'));
    }

    function canceled(Request $request){
        $invoice = new Invoice();

        $invoice = $this->search_same($invoice,$request);

        $invoice = $invoice->where('status','canceled')
            ->orderBy('id','desc')
            ->paginate(10);

        return view("admin.invoice-canceled",compact('invoice','request'));
    }

    function expiredPayment(Request $request){
        $invoice = new Invoice();

        $invoice = $this->search_same($invoice,$request);

        $invoice = $invoice->where('status','expired payment')
            ->orderBy('id','desc')
            ->paginate(10);

        return view("admin.invoice-expired-payment",compact('invoice','request'));
    }

    function expiredInvoice(Request $request){
        $invoice = new Invoice();

        $invoice = $this->search_same($invoice,$request);

        $invoice = $invoice->where('status','expired invoice')
            ->orderBy('id','desc')
            ->paginate(10);

        return view("admin.invoice-expired-invoice",compact('invoice','request'));
    }

    function payment(Request $request){
        $invoice = new Invoice();

        $invoice = $this->search_same($invoice,$request);

        $invoice = $invoice->where('status','payment')
            ->orderBy('id','desc')
            ->paginate(10);

        return view("admin.invoice-payment",compact('invoice','request'));
    }


    function prepare(Request $request){
        $invoice = new Invoice();

        $invoice = $this->search_same($invoice,$request);

        $invoice = $invoice->where('status','prepare')
            ->orderBy('id','desc')
            ->paginate(10);

        return view("admin.invoice-prepare",compact('invoice','request'));
    }

    function inRent(Request $request){
        $invoice = new Invoice();

        $invoice = $this->search_same($invoice,$request);

        $invoice = $invoice->where('status','in rent')
            ->orderBy('id','desc')
            ->paginate(10);

        return view("admin.invoice-in-rent",compact('invoice','request'));
    }

    function backingStuff(Request $request){
        $invoice = new Invoice();

        $invoice = $this->search_same($invoice,$request);

        $invoice = $invoice->where('status','backing stuff')
            ->orderBy('id','desc')
            ->paginate(10);

        return view("admin.invoice-backing-stuff",compact('invoice','request'));
    }

     function withdrawingStuff(Request $request){
        $invoice = new Invoice();

        $invoice = $this->search_same($invoice,$request);

        $invoice = $invoice->where('status','withdrawing stuff')
            ->orderBy('id','desc')
            ->paginate(10);

        return view("admin.invoice-withdrawing-stuff",compact('invoice','request'));
    }

    function search_same($invoice,$request){
        $invoice = $invoice->with(["user"]);
        
        if($request->has('first_name') && !empty($request->first_name)){
            $search = $request->first_name;

            $invoice = $invoice->whereHas('user',function($q) use ($search){
                $q->where('first_name','like','%'.$search.'%');
            });
        }

        if($request->has('form_id') && $request->has('to_id') && !empty($request->form_id) && !empty($request->has('to_id'))){
            $invoice = $invoice->whereBetween("id",[$request->form_id,$request->to_id]);
        }

        if($request->has('status_payment') && !empty($request->status_payment)){
            $invoice = $invoice->where('status_payment',$request->status_payment);
        }

        if($request->has('total') && !empty($request->total)){
            $invoice = $invoice->where("total",$request->total);
        }

        if($request->has('search_created_at') && !empty($request->search_created_at)){
            $dateCreated = explode(" - ",$request->search_created_at);
        
            if(is_array($dateCreated)){              
                $startDate = $dateCreated[0];
                $endDate = $dateCreated[1];

                $invoice = $invoice->whereBetween("created_at",[$startDate,$endDate]);
            }
        }

        return $invoice;
    }


    function detail(Request $request,$id){
        $invoice = Invoice::with(['user','manual_payments','order_items','order_items.product'])->where('id',$id)->first();

        if(!$invoice){
            return redirect()
            ->back()
            ->with([
                "error" => [
                    "title" => "Terjadi Kesalahan",
                    "text" => "Data invoice tidak ditemukan"
                ]
            ]);
        }

        return view("admin.invoice-detail",compact("invoice"));
    }
}