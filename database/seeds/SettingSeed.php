<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
        // sudah di gunakan
        Setting::create([
          "name" => "site_name",
          "value" => "CampRent"
        ]);
     
        // sudah di gunakan
       	Setting::create([
       		"name" => "meta_description",
       		"value" => "Meta Rental"
       	]);

        // sudah di gunakan
        Setting::create([
          "name" => "footer_contact_us",
          "value" => "cs@camp-rent.com"
        ]);

        // sudah di gunakan
        Setting::create([
          "name" => "city",
          "value" => "semarang"
        ]);

        // sudah di gunakan
       	Setting::create([
       		"name" => "max_order",
       		"value" => 3
       	]);

        // sudah di gunakan
       	Setting::create([
       		"name" => "max_wishlist",
       		"value" => 10
       	]);

        // sudah di gunakan
        Setting::create([
          "name" => "min_rent_product",
          "value" => 7 
        ]);

        // sudah di gunakan
        Setting::create([
          "name" => "max_rent_product",
          "value" => 30
        ]);

        // sudah di gunakan
        Setting::create([
          "name" => "expired_invoice",
          "value" => 3
        ]);

       	Setting::create([
       		"name" => "time_backing_stuff",
       		"value" => 1
       	]);
    }
}
