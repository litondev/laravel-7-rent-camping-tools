<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->bigInteger("user_id")->unsigned();                        
            $table->enum("status",
                array(
                    "pending",
                    "payment",
                    "rejected",
                    "canceled",
                    "prepare",
                    "withdrawing stuff",
                    "in rent",
                    "backing stuff",
                    "expired payment",
                    "expired invoice",
                    "completed"
                )
            )->default("pending");
            $table->timestamp("start_rent")->nullable();
            $table->timestamp("end_rent")->nullable();
            $table->timestamp("expired_payment")->nullable();            
            $table->bigInteger("total")->default(0);
            $table->boolean("is_fine")->default(0);
            $table->text("fine_description")->nullable();        
            $table->bigInteger("fine_total")->default(0);            
            $table->enum("status_payment",array("paid","unpaid","expired"))->default("unpaid");            
            $table->enum("guaranteing",array("ktp","sim"))->default("ktp");
            $table->timestamps();

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
        Schema::dropIfExists('invoices');
    }
}
