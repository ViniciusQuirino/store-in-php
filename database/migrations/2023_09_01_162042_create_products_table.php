<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary('id');

            $table->string('name', 100);
            $table->decimal('value', 10, 2);
            $table->integer('stock');
            $table->string('status', 15);
            $table->string('category', 40);

            $table->string('imagem', 255)->nullable();

            $table->uuid('seller_id');
            $table
                ->foreign('seller_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
