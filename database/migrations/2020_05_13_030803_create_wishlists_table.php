<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();            
            $table->bigInteger("product_id")->unsigned();
            $table->bigInteger("user_id")->unsigned();
            $table->timestamps();

            $table->foreign('product_id')
                  ->references('id')->on('products');

            $table->foreign("user_id")
                  ->references("id")->on("users");   
        });           
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishlists');
    }
}
