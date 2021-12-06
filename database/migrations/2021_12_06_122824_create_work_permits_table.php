<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkPermitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_permits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maker_id');
            $table->datetime('from');
            $table->datetime('to');
            $table->string('reason', 1000);
            $table->unsignedBigInteger('approved_by1');
            $table->datetime('approved_at1');
            $table->unsignedBigInteger('approved_by2');
            $table->datetime('approved_at2');
            $table->unsignedBigInteger('approved_by3');
            $table->datetime('approved_at3');
            $table->string('reject_reason');
            $table->datetime('rejected_at');
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreign('maker_id')->references('id')->on('users');
            $table->foreign('approved_by1')->references('id')->on('users');
            $table->foreign('approved_by2')->references('id')->on('users');
            $table->foreign('approved_by3')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_permits');
    }
}
