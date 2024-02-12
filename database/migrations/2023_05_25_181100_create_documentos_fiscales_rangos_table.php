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
        Schema::create('documentos_fiscales_rangos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_inicial',22);
            $table->string('numero_final',22);
            $table->integer('cantidad_otorgada');
            $table->integer('cantidad_emitidas')->default(0);
            $table->date('fecha_limite_emision');
            $table->string('numero_cai',100);        
            $table->enum('status',[1,2])->default(2);
            $table->date('fecha_cierre')->nullable();
            $table->unsignedBigInteger('documento_tipo_id');
            $table->timestamps();
            $table->foreign('documento_tipo_id')->references('id')->on('documentos_fiscales_tipos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_fiscales_rangos');
    }
};
