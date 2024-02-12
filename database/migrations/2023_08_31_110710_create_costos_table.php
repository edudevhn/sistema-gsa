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
        Schema::create('costos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_factura')->default(NOW());
            $table->text('descripcion')->nullable();
            $table->string('documento_cobro',45)->nullable();
            $table->decimal('valor_neto_factura', $precision = 15, $scale = 2)->default(0);
            $table->decimal('isv', $precision = 15, $scale = 2)->default(0);
            $table->decimal('total', $precision = 15, $scale = 2)->default(0);
            $table->text('observaciones')->nullable();
            $table->unsignedBigInteger('servicio_id');
            $table->unsignedBigInteger('proveedor_id');
            $table->unsignedBigInteger('tipo_costo_id');
            $table->unsignedBigInteger('moneda_id');
            $table->timestamps();
            $table->foreign('proveedor_id')->references('id')->on('personas')->onDelete('cascade');
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
            $table->foreign('tipo_costo_id')->references('id')->on('tipo_costos')->onDelete('cascade');
            $table->foreign('moneda_id')->references('id')->on('monedas')->onDelete('cascade');
        });
    }
    


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costos');
    }
};
