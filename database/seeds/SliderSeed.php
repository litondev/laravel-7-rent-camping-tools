<?php

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i=1;$i<3;$i++){    		
        	Slider::create([
        		"link" => "http://localhost",
        		"image" => "slider".$i.".png",        		  	
                "status" => "aktif"
        	]);
        }
    }
}
