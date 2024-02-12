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
        Schema::create('persona_exoneracion', function (Blueprint $table) {
            $table->id();
            $table->string('registro',22)->unique();    
            $table->enum('status',[1,2])->default(2);
            $table->date('fecha_vencimiento')->nullable();  
            $table->timestamps();
            $table->unsignedBigInteger('persona_id');
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona_exoneracion');
    }
};
