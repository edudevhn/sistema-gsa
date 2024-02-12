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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_interno')->nullable();
            $table->text('descripcion')->nullable();
            $table->enum('status',[1,2])->default(2);
            $table->unsignedBigInteger('cuenta_id');
            $table->unsignedBigInteger('value_type_id');
            $table->timestamps();
            $table->foreign('cuenta_id')->references('id')->on('cuentas')->onDelete('cascade');
            $table->foreign('value_type_id')->references('id')->on('value_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
