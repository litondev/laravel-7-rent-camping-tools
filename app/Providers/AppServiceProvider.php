<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use App\Models\Setting;
use Schema,Config;

class AppServiceProvider extends ServiceProvider
{
    public $settings = [
        "image_max_upload" => 10024,
        "image_allow_upload" => "image/jpeg,image/jpg,image/gif,image/png,jpeg,jpg,gif,png",
        "image_max_dim" => 5000,       

        "folder_proofs" => "/images/proofs/",
        "folder_infos" => "/images/infos/",
        "folder_categories" => "/images/categories/",
        "folder_notifs" => "/images/notifs/",
        "folder_products" => "/images/products/",
        "folder_sliders" => "/images/sliders/"
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        setLocale(LC_ALL,"id_ID.utf8");

        Carbon::setLocale("id_ID.utf8");
        
        date_default_timezone_set('Asia/Jakarta');

        // DIGUNAKAN KETIKA PRODUCTION MODE DAN MEMAKAI SSL
        if(env('PRODMODESSL','no') == 'yes'){
          \URL::forceScheme('https');
        }

        // SET CONFIG GLOBAL IMAGE ADAN FOLDER PATH
        foreach($this->settings as $key => $item){
            Config::set("app.".$key,$item);
        }    
    
        // SET CONFIG GLOBAL DARI DATABASE SETTING
        try{
            foreach (Setting::all() as $item){
                if(intval($item->json) == 1){
                    Config::set("app.".$item->name,json_decode($item->value));
                }else{            
                    Config::set("app.".$item->name,$item->value);
                }
            }
        }catch(\Exception $e){
            
        }
    }
}
