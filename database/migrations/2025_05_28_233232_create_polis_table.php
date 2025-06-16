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
        Schema::create('polis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_poli', 100); 
            $table->unsignedBigInteger('id_dokter');
            $table->unsignedBigInteger('id_perawat');
            $table->timestamps();
        });
        // Foreign key constraints (assuming tables 'dokters' and 'perawats' exist)
        Schema::table('polis', function (Blueprint $table) {
            $table->foreign('id_dokter')->references('id')->on('dokters')->onDelete('cascade');
            $table->foreign('id_perawat')->references('id')->on('perawats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polis');
    }
};
