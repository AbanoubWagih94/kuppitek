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
            $table->id();
            $table->text('title', 200);
            $table->unsignedBigInteger('category_id');
            $table->string('quantity');
            $table->string('cost_price');
            $table->string('selling_price');
            $table->text('ingredients');
            $table->boolean('discount')->default(false);
            $table->integer('discount_value')->default(0);
            $table->text('image_path')->default(null);
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('menu_categories')->onDelete('cascade');;
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
