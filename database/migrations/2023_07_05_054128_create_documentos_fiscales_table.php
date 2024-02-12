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
        Schema::create('documentos_fiscales', function (Blueprint $table) {
            $table->id();
            $table->string('numero_documento',22)->unique();            
            $table->decimal('sub_total', $precision = 15, $scale = 2)->default(0);
            $table->decimal('isv', $precision = 15, $scale = 2)->default(0);
            $table->decimal('total', $precision = 15, $scale = 2)->default(0);
            $table->unsignedBigInteger('documentos_fiscales_rango_id');
            $table->unsignedBigInteger('documento_tipo_id');
            $table->unsignedBigInteger('documento_fiscal_detalle_id');
            $table->unsignedBigInteger('embarque_id');
            $table->timestamps();
            $table->foreign('documento_tipo_id')->references('id')->on('documentos_fiscales_tipos')->onDelete('cascade');
            $table->foreign('documentos_fiscales_rango_id')->references('id')->on('documentos_fiscales_rangos')->onDelete('cascade');
            $table->foreign('documento_fiscal_detalle_id')->references('id')->on('documentos_fiscales_detalles')->onDelete('cascade');
            $table->foreign('embarque_id')->references('id')->on('embarques')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_fiscales');
    }
};
