<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    	
      User::create([
      	"first_name" => "admin",
      	"last_name" => "admin",
      	"email" => "admin@admin.com",
      	"password" => Hash::make("12345678"),
      	"phone" => "08978797668",
      	"address" => "Kota/Kabupaten Kecamatan Desa Rw Rt",
      	"role" => "admin"
      ]);
      
      User::create([
        "first_name" => "user",
        "last_name" => "user",
        "email" => "user@user.com",
        "password" => Hash::make("12345678"),
        "phone" => "0897886868",
        "address" => "Kota/Kabupaten Kecamatan Desa Rw Rt",
        "role" => "user"
      ]);
      
      factory(User::class,50)->create();
    }
}
