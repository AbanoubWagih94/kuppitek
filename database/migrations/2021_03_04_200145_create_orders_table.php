<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('table_id')->nullable();
            $table->unsignedBigInteger('counter_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('total_cost');
            $table->unsignedInteger('order_status')->default(0);
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('table_id')->references('id')->on('tables');
            $table->foreign('counter_id')->references('id')->on('counters');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
