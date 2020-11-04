<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
	protected $table = "products";	

    protected $guarded = ["id"];

    protected $appends = [
    	"get_rent_price",
    	"get_images",
        "get_human_created_at",
        "get_human_updated_at"
    ];

    public function category(){
    	return $this->belongsTo("App\Models\Category");
    }

    public function wishlists(){
        return $this->hasMany("App\Models\Wishlist");
    }

    public function reviews(){
        return $this->hasMany("App\Models\Review");
    }

    public function order_items(){
        return $this->hasMany("App\Models\OrderItem");
    }

    public function getGetRentPriceAttribute(){
    	if(isset($this->attributes["rent_price"])){    	
    		return "Rp ".number_format(intval($this->attributes["rent_price"]),"2");    	
    	}

    	return "Rp 0";
    }

    public function getGetImagesAttribute(){
    	if(isset($this->attributes["images"])){    	
    		return json_decode($this->attributes["images"]);
    	}

    	return [];
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
