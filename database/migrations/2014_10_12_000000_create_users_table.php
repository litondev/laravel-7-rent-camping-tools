<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('first_name',25);
            $table->string("last_name",25);            
            $table->string('email',50)->unique();
            $table->string('password');
            $table->string("phone",25)->unique();
            $table->text("address");
            $table->enum("gender",array("male","female"))->default("male");
            $table->enum("status",array("aktif","blokir"))->default("aktif");        
            $table->text("description_blokir")->nullable();                        
            $table->timestamp("last_login")->nullable();
            $table->enum("role",array("admin","user"))->default("user");
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
