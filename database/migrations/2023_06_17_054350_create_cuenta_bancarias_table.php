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
        Schema::create('cuenta_bancarias', function (Blueprint $table) {
            $table->id();
            $table->string('num_cuenta');
            $table->string('name');
            $table->string('beneficiario')->nullable();
            $table->string('rtn')->nullable();
            $table->enum('predeterminada',[1,2])->default(2);
            $table->enum('status',[1,2])->default(2);
            $table->unsignedBigInteger('moneda_id');
            $table->unsignedBigInteger('banco_id');
            $table->unsignedBigInteger('tipo_cuenta_id');
            $table->timestamps();
            $table->foreign('moneda_id')->references('id')->on('monedas')->onDelete('cascade');
            $table->foreign('banco_id')->references('id')->on('bancos')->onDelete('cascade');
            $table->foreign('tipo_cuenta_id')->references('id')->on('tipo_cuentas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuenta_bancarias');
    }
};