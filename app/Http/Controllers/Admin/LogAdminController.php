<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogAdmin;

class LogAdminController extends Controller
{
    function index(Request $request){
    	$logAdmin = new LogAdmin();

    	if($request->has('form_id') && $request->has('to_id') && !empty($request->form_id) && !empty($request->has('to_id'))){
    		$logAdmin = $logAdmin->whereBetween("id",[$request->form_id,$request->to_id]);
    	}

    	if($request->has('name') && !empty($request->name)){
    		$logAdmin = $logAdmin->where('name','like','%'.$request->name.'%');
    	}    	

    	if($request->has('ip') && !empty($request->ip)){
    		$logAdmin = $logAdmin->where('ip','like','%'.$request->ip.'%');
    	}

    	if($request->has('agent') && !empty($request->agent)){
    		$logAdmin = $logAdmin->where('user_agent','like','%'.$request->agent."%");
    	}

    	if($request->has('search_created_at') && !empty($request->search_created_at)){
    		$dateCreated = explode(" - ",$request->search_created_at);
        
            if(is_array($dateCreated)){              
            	$startDate = $dateCreated[0];
            	$endDate = $dateCreated[1];

            	$logAdmin = $logAdmin->whereBetween("created_at",[$startDate,$endDate]);
            }
    	}

    	$logAdmin = $logAdmin->orderBy('id','desc')->paginate(10);

    	return view("admin.log-admin",compact('logAdmin','request'));
    }
}
