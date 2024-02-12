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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('rtn',15)->unique()->nullable();
            $table->string('telefono',15)->nullable();
            $table->string('email')->nullable();
            $table->text('direccion_fiscal')->nullable();
            $table->enum('exonerado',[1,2])->default(2);
            $table->string('dias_pago')->nullable();
            $table->unsignedBigInteger('tipo_persona_id');
            $table->unsignedBigInteger('entidad_id');
            $table->unsignedBigInteger('termino_pago_id')->nullable();
            $table->timestamps();
            $table->foreign('tipo_persona_id')->references('id')->on('tipos_personas')->onDelete('cascade');
            $table->foreign('entidad_id')->references('id')->on('entidades')->onDelete('cascade');
            $table->foreign('termino_pago_id')->references('id')->on('terminos_pagos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
