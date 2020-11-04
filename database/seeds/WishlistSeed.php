<?php

use Illuminate\Database\Seeder;
use App\Models\Wishlist;

class WishlistSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i=0;$i<100;$i++){
        	Wishlist::create([
        		"product_id" => ($i+1),
        		"user_id" => 1
        	]);
        }
    }
}
