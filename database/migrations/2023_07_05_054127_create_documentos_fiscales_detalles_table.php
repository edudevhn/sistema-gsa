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
        Schema::create('documentos_fiscales_detalles', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_emision')->default(NOW());
            $table->date('fecha_vencimiento')->default(NOW());
            $table->string('embarcador',45)->nullable();
            $table->string('consignatario',45)->nullable();
            $table->string('no_booking',45)->nullable();
            $table->string('no_documento_transporte',45)->nullable();
            $table->string('pieza',45)->nullable();
            $table->string('peso',45)->nullable();
            $table->string('equipo',45)->nullable();
            $table->text('referencia_interna')->nullable();
            $table->text('duca')->nullable();
            $table->text('observaciones')->nullable();
            $table->year('periodo_sys')->default(date('Y'));
            $table->decimal('tc_hnd', $precision = 15, $scale = 2)->default(0);
            $table->decimal('tc_usd', $precision = 15, $scale = 2)->default(0);
            $table->decimal('importe_gravado', $precision = 15, $scale = 2)->default(0);
            $table->decimal('importe_exento', $precision = 15, $scale = 2)->default(0);
            $table->decimal('descuento', $precision = 15, $scale = 2)->default(0);
            $table->decimal('importe_exonerado', $precision = 15, $scale = 2)->default(0);
            $table->decimal('sub_total', $precision = 15, $scale = 2)->default(0);
            $table->decimal('isv', $precision = 15, $scale = 2)->default(0);
            $table->decimal('total', $precision = 15, $scale = 2)->default(0);
            $table->decimal('tasa_convercion', $precision = 15, $scale = 2)->default(0);
            $table->text('no_sag')->nullable();
            $table->text('no_compra_externa')->nullable();
            $table->text('no_exonerado')->nullable();
            $table->unsignedBigInteger('moneda_id');
            $table->timestamps();
            $table->foreign('moneda_id')->references('id')->on('monedas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_fiscales_detalles');
    }
};
