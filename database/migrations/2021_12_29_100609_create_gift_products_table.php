<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('gift_id');


            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('gift_id')->references('id')->on('gifts');


            $table->unique(['gift_id', 'product_id']);
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
        Schema::dropIfExists('gift_products');
    }
}
