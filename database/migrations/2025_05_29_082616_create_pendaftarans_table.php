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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('rm', false, true);
            $table->unsignedBigInteger('id_poli', false, true);
            $table->dateTime('tgl_kunjungan');
            $table->smallInteger('no_antrian');
            $table->char('status', 10); // 0 = Menggunggu, 1 = Dipanggil, 2 = diperika 3 = Selesai           
            $table->timestamps();
        });
        // Foreign key constraints (assuming table 'polis' exists)
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->foreign('id_poli')->references('id')->on('polis')->onDelete('cascade');
        });
        // Foreign key constraints (assuming table 'pasiens' exists)
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->foreign('rm')->references('rm')->on('pasiens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
