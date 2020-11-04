<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manual_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("invoice_id")->unsigned();
            $table->string("proof",25);
            $table->text("description");
            $table->enum("status",array("failed","success","validasi"))->default("validasi");
            $table->text("status_description")->nullable();
            $table->timestamps();

            $table->foreign('invoice_id')
              ->references('id')
              ->on('invoices');

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
        Schema::dropIfExists('manual_payments');
    }
}
