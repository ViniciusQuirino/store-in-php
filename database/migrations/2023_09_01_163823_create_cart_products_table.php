<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_products', function (Blueprint $table) {
            $table->uuid('id')->primary('id');

            $table->integer('amount')->default(1);

            $table->uuid('cart_id')->nullable();
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');

            $table->uuid('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_products');
    }
};
