<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NotifAdmin;

class NotifAdminController extends Controller
{
    function index(Request $request){
    	$notifAdmin = new NotifAdmin();

    	if($request->has('form_id') && $request->has('to_id') && !empty($request->form_id) && !empty($request->has('to_id'))){
    		$notifAdmin = $notifAdmin->whereBetween("id",[$request->form_id,$request->to_id]);
    	}

    	if($request->has('content') && !empty($request->content)){
    		$notifAdmin = $notifAdmin->where('content','like','%'.$request->content."%");
    	}

    	if($request->has('search_created_at') && !empty($request->search_created_at)){
    		$dateCreated = explode(" - ",$request->search_created_at);
        
            if(is_array($dateCreated)){              
            	$startDate = $dateCreated[0];
            	$endDate = $dateCreated[1];

            	$notifAdmin = $notifAdmin->whereBetween("created_at",[$startDate,$endDate]);
            }
    	}

    	$notifAdmin = $notifAdmin->orderBy('id','desc')->paginate(10);

    	return view("admin.notif-admin",compact('notifAdmin','request'));
    }
}
