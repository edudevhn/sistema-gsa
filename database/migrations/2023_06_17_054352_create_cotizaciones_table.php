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
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->string('num_documento',60)->unique();
            $table->date('fecha')->default(NOW());
            $table->unsignedBigInteger('moneda_id');
            $table->unsignedBigInteger('mercancia_id');
            $table->unsignedBigInteger('incoterm_id');
            $table->unsignedBigInteger('tipo_servicio_id');
            $table->unsignedBigInteger('aduana_id');
            $table->unsignedBigInteger('lugar_embarque_id');
            $table->unsignedBigInteger('lugar_entrega_id');
            $table->unsignedBigInteger('termino_pago_id');
            $table->unsignedBigInteger('modalidad_id');
            $table->unsignedBigInteger('persona_id');
            $table->string('num_referencia',45)->nullable();
            $table->date('fecha_valida')->nullable();
            $table->text('notas')->nullable();
            $table->year('periodo_sys')->default(date('Y'));
            $table->decimal('tc_hnd', $precision = 15, $scale = 2)->default(0);
            $table->decimal('tc_usd', $precision = 15, $scale = 2)->default(0);
            $table->decimal('total', $precision = 15, $scale = 2)->default(0);
            $table->timestamps();
            $table->foreign('moneda_id')->references('id')->on('monedas')->onDelete('cascade');
            $table->foreign('mercancia_id')->references('id')->on('mercancias')->onDelete('cascade');
            $table->foreign('incoterm_id')->references('id')->on('incoterms')->onDelete('cascade');
            $table->foreign('tipo_servicio_id')->references('id')->on('tipos_servicios')->onDelete('cascade');
            $table->foreign('aduana_id')->references('id')->on('aduanas')->onDelete('cascade');
            $table->foreign('lugar_embarque_id')->references('id')->on('destinos')->onDelete('cascade');
            $table->foreign('lugar_entrega_id')->references('id')->on('destinos')->onDelete('cascade');
            $table->foreign('termino_pago_id')->references('id')->on('terminos_pagos')->onDelete('cascade');
            $table->foreign('modalidad_id')->references('id')->on('modalidades')->onDelete('cascade');
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizaciones');
    }
};
