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
        Schema::create('proforma_estados', function (Blueprint $table) {
            $table->unsignedBigInteger('proforma_id');
            $table->string('estado',25);
            $table->text('observacion')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('proforma_id')->references('id')->on('proformas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proforma_estados');
    }
};
