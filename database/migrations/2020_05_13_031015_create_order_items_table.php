<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("invoice_id")->nullable()->unsigned();
            $table->bigInteger("product_id")->unsigned();
            $table->bigInteger("user_id")->unsigned();
            $table->enum("status",array("cart","invoice"))->default("cart");
            $table->timestamps();

            $table->foreign('product_id')
              ->references('id')
              ->on('products');

            $table->foreign("invoice_id")
              ->references("id")
              ->on("invoices");     

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
        Schema::dropIfExists('order_items');
    }
}
