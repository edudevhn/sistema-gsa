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
        Schema::create('cotizacion_servicio', function (Blueprint $table) {
            $table->decimal('precio', $precision = 15, $scale = 2);
            $table->decimal('cantidad', $precision = 15, $scale = 0);
            $table->decimal('isv', $precision = 15, $scale = 2);
            $table->decimal('total', $precision = 15, $scale = 2);
            $table->text('descripcion')->nullable();
            $table->text('unidad_medida')->nullable();
            $table->unsignedBigInteger('cotizacion_id');
            $table->unsignedBigInteger('servicio_id');
            $table->foreign('cotizacion_id')->references('id')->on('cotizaciones')->onDelete('cascade');
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizacion_servicio');
    }
};
