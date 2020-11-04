<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OrderItem extends Model
{
	protected $table = "order_items";

    protected $guarded = ["id"];

    protected $appends = [    
        "get_human_created_at",
        "get_human_updated_at"
    ];

    public function invoice(){
    	return $this->belongsTo("App\Models\Invoice");
    }

    public function product(){
    	return $this->belongsTo("App\Models\Product");
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
