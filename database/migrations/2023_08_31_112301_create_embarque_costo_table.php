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
        Schema::create('embarque_costo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('embarque_id');
            $table->unsignedBigInteger('costo_id');
            $table->foreign('embarque_id')->references('id')->on('embarques')->onDelete('cascade');
            $table->foreign('costo_id')->references('id')->on('costos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('embarque_costo');
    }
};
