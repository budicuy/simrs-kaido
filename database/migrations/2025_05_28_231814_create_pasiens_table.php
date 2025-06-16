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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->unsignedInteger('rm')->primary();
            $table->unsignedBigInteger('nik')->unique();
            $table->string('nama_pasien', 100);
            $table->date('tgl_lahir');
            $table->char('agama');
            $table->char('kabupaten');
            $table->string('pekerjaan', 50);
            $table->enum('jns_kelamin', ['pria', 'perempuan']);
            $table->string('alamat', 100);
            $table->char('no_hp_pasien', 15);
            $table->string('email_pasien', 20);
            $table->char('gol_darah', 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
