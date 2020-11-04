<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           $imgs = ["img1.png","img2.png","img3.png","img4.png","img5.png","img6.png","img7.png"];
           $prices = [100000,200000,300000];

           for($i=0;$i<800;$i++){           		
           		$img = [
                $imgs[rand(0,6)],
                $imgs[rand(0,6)],
                $imgs[rand(0,6)]
              ];              

           		Product::create([
           			"name" => "Product ".$i,
           			"category_id" => rand(1,3),
           			"rent_price" =>  $prices[rand(0,2)],
           			"description" => "Desc",
           			"condition" => "Syarat dan ketentuan",
           			"fine" => "Denda",
           			"question" => "Pertanyaan",
           			"images" => json_encode($img),
           			"status" => "aktif"
           		]);
           }
    }
}
