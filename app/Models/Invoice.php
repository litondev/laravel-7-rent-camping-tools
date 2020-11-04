<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Invoice extends Model
{
	protected $table = "invoices";

    protected $guarded = ["id"];

    protected $dates = [
    	"end_rent",
        "start_rent",
        "expired_payment"
    ];

    protected $appends = [    
        "get_human_created_at",
        "get_human_updated_at"
    ];
    
    public function order_items(){
    	return $this->hasMany("App\Models\OrderItem");
    }

    public function manual_payments(){
    	return $this->hasMany("App\Models\ManualPayment");
    }

    public function user(){
        return $this->belongsTo("App\Models\User");
    }

    public function getGetHumanCreatedAtAttribute(){
        if(isset($this->attributes["created_at"])){
           return Carbon::parse($this->attributes['created_at'])->diffForHumans();    
        }

        return Null;
    }

    public function getGetHumanUpdatedAtAttribute(){
        if(isset($this->attributes["updated_at"])){
           return Carbon::parse($this->attributes['updated_at'])->diffForHumans();    
        }

        return Null;
    }
}
