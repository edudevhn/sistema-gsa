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
        Schema::create('embarques', function (Blueprint $table) {
            $table->id();
            $table->string('num_embarque',60)->unique();
            $table->date('fecha')->default(NOW());
            $table->date('fecha_valida')->nullable();
            $table->text('notas')->nullable();
            $table->year('periodo_sys')->default(date('Y'));
            $table->string('embarcador',45)->nullable();
            $table->string('consignatario',45)->nullable();
            $table->string('no_booking',45)->nullable();
            $table->string('no_documento_transporte',45)->nullable();
            $table->string('peso',45)->nullable();
            $table->string('equipo',45)->nullable();
            $table->text('no_sag')->nullable();
            $table->text('no_compra_externa')->nullable();
            $table->unsignedBigInteger('mercancia_id');
            $table->unsignedBigInteger('incoterm_id');
            $table->unsignedBigInteger('tipo_servicio_id');
            $table->unsignedBigInteger('aduana_id');
            $table->unsignedBigInteger('lugar_embarque_id');
            $table->unsignedBigInteger('lugar_entrega_id');
            $table->unsignedBigInteger('termino_pago_id');
            $table->unsignedBigInteger('modalidad_id');
            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('moneda_id');
            //$table->unsignedBigInteger('pol_id');
            //$table->unsignedBigInteger('pod_id');
            $table->unsignedBigInteger('embarque_principal_id')->nullable();
            $table->timestamps();
            $table->foreign('mercancia_id')->references('id')->on('mercancias')->onDelete('cascade');
            $table->foreign('incoterm_id')->references('id')->on('incoterms')->onDelete('cascade');
            $table->foreign('tipo_servicio_id')->references('id')->on('tipos_servicios')->onDelete('cascade');
            $table->foreign('aduana_id')->references('id')->on('aduanas')->onDelete('cascade');
            $table->foreign('lugar_embarque_id')->references('id')->on('destinos')->onDelete('cascade');
            $table->foreign('lugar_entrega_id')->references('id')->on('destinos')->onDelete('cascade');
            $table->foreign('termino_pago_id')->references('id')->on('terminos_pagos')->onDelete('cascade');
            $table->foreign('modalidad_id')->references('id')->on('modalidades')->onDelete('cascade');
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
            //$table->foreign('pol_id')->references('id')->on('fronteras')->onDelete('cascade');
            //$table->foreign('pod_id')->references('id')->on('fronteras')->onDelete('cascade');
            $table->foreign('embarque_principal_id')->references('id')->on('embarques')->onDelete('cascade');
            $table->foreign('moneda_id')->references('id')->on('monedas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('embarques');
    }
};
