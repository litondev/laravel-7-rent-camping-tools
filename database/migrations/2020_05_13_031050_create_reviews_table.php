<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("product_id")->unsigned();
            $table->tinyInteger("star")->default(1);
            $table->text("komentar");
            $table->text("replay")->nullable();
            
            $table->timestamps();

            $table->foreign('product_id')
              ->references('id')
              ->on('products');

            $table->foreign("user_id")
              ->references("id")
              ->on("users");  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
