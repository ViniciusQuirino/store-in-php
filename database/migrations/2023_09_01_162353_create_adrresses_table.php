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
        Schema::create('adrresses', function (Blueprint $table) {
            $table->uuid('id')->primary('id');

            $table->string('street', 100);
            $table->integer('number');
            $table->string('destrict', 100);
            $table->string('city', 100);
            $table->string('complement', 255);
            $table->string('zip_code', 8);

            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adrresses');
    }
};
