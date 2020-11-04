<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    protected $table = "users";
    
    use Notifiable;

    protected $guarded = [
        'id'
    ];

    protected $dates = [
        "last_login"
    ];

    protected $hidden = [
        'password', 
        'remember_token',
    ];

    protected $appends = [    
        "get_human_created_at",
        "get_human_updated_at"
    ];

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
