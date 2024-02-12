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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string('num_documento',60)->unique();
            $table->date('fecha')->default(NOW());
            $table->string('referencia',45)->nullable();
            $table->date('fecha_pago')->default(NOW());
           // $table->string('descripcion',45)->nullable();
            $table->string('constancia_retencion',45)->nullable();
            $table->decimal('valor_facturado', $precision = 15, $scale = 2)->default(0);
            $table->decimal('pago_recibido', $precision = 15, $scale = 2)->default(0);
            $table->decimal('saldo_actual', $precision = 15, $scale = 2)->default(0);
            $table->decimal('pago_actual', $precision = 15, $scale = 2)->default(0);
            $table->decimal('retencion', $precision = 15, $scale = 2)->default(0);
            $table->decimal('saldo', $precision = 15, $scale = 2)->default(0);
            $table->decimal('total_pago_aplicado', $precision = 15, $scale = 2)->default(0);
            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('banco_id');
            $table->unsignedBigInteger('moneda_id');
            $table->unsignedBigInteger('documento_fiscal_id');
            $table->unsignedBigInteger('cuenta_bancaria_id');
            $table->unsignedBigInteger('metodo_pago_id');
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');  
            $table->foreign('banco_id')->references('id')->on('bancos')->onDelete('cascade');  
            $table->foreign('moneda_id')->references('id')->on('monedas')->onDelete('cascade');
            $table->foreign('documento_fiscal_id')->references('id')->on('documentos_fiscales')->onDelete('cascade');
            $table->foreign('cuenta_bancaria_id')->references('id')->on('cuenta_bancarias')->onDelete('cascade');
            $table->foreign('metodo_pago_id')->references('id')->on('metodo_pagos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
