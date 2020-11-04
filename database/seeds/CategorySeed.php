<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$kategori = [
            [
                "nama" => "Tenda",
                "img" => "tent.png"
            ],          
            [
                "nama" => "Tas",
                "img" => "bag.png"
            ],                              
            [
                "nama" => "Kamera",
                "img" => "camera.png"
            ],
    		[
    			"nama" => "Alat Pematik api",
                "img" => "flame.png"
    		],
            [
                "nama" => "Alat Penerangan",
                "img" => "lamp.png"
            ],
            [
                "nama" => "Perlengkapan P3k",
                "img" => "health-box.png"
            ],
            [
                "nama" => "Perlengkapan Tidur",
                "img" => "room.png"
            ],
            [
                "nama" => "Perlengkapan Harian",
                "img" => "merchant.png"
            ],
            [
                "nama" => "Lain-Lain",
                "img" => "others.png"
            ],
    	];

    	for($i=0;$i<count($kategori);$i++){
        	Category::create([
	        	"name" => $kategori[$i]["nama"],
        		"image" => $kategori[$i]['img'],
        		"status"  => "aktif"
        	]);        	
        }
    }
}
