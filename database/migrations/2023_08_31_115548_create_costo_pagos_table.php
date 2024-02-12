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
        Schema::create('costo_pagos', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_pago', $precision = 15, $scale = 2)->default(0);
            $table->unsignedBigInteger('costo_id');
            $table->unsignedBigInteger('cuenta_bancaria_id');
            $table->foreign('costo_id')->references('id')->on('costos')->onDelete('cascade');
            $table->foreign('cuenta_bancaria_id')->references('id')->on('cuenta_bancarias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costo_pagos');
    }
};
