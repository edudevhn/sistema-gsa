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
        Schema::create('embarque_cotizacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('embarque_id');
            $table->unsignedBigInteger('cotizacion_id');
            $table->timestamps();
            $table->foreign('embarque_id')->references('id')->on('embarques')->onDelete('cascade');
            $table->foreign('cotizacion_id')->references('id')->on('cotizaciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('embarque_cotizacion');
    }
};
