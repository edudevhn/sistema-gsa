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
        Schema::create('documentos_fiscales_servicios', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio', $precision = 15, $scale = 2);
            $table->decimal('cantidad', $precision = 15, $scale = 0);
            $table->decimal('isv', $precision = 15, $scale = 2);
            $table->decimal('total', $precision = 15, $scale = 2);
            $table->text('descripcion')->nullable();
            $table->text('unidad_medida')->nullable();
            $table->unsignedBigInteger('documento_fiscal_id');
            $table->unsignedBigInteger('servicio_id');
            $table->foreign('documento_fiscal_id')->references('id')->on('documentos_fiscales')->onDelete('cascade');
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_fiscales_servicios');
    }
};
