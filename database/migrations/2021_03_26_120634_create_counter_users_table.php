<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counter_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('counter_id');
            $table->unsignedBigInteger('user_id');
            $table->string('start_money');
            $table->timestamps();
            $table->foreign('counter_id')->references('id')->on('counters')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counter_users');
    }
}
