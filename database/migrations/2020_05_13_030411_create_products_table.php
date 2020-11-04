<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string("name",25);
            $table->bigInteger("category_id")->unsigned();
            $table->bigInteger("rent_price")->default(0);
            $table->boolean("status_rent")->default(0);
            $table->bigInteger("star")->default(0);
            $table->text("description");
            $table->text("condition");
            $table->text("fine");
            $table->text("question");
            $table->text("images");
            $table->enum("status",array("aktif","nonaktif"))->default("nonaktif");            
            $table->timestamps();

            $table->foreign('category_id')
              ->references('id')
              ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
