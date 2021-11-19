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
            $table->id();
            $table->unsignedBigInteger('branch_id');
            $table->string('name', 200);
            $table->string('surname', 200);
            $table->string('email', 200);
            $table->string('phone', 50);
            $table->string('qr_code_link', 200)->nullable();
            $table->string('qr_code_image', 200)->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
            
            $table->foreign('branch_id')->references('id')->on('branch');
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
