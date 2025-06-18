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
            $table->unsignedInteger('rm')->unique();
            $table->unsignedBigInteger('nik')->unique();
            $table->string('nama_pasien');
            $table->date('tgl_lahir');
            $table->string('agama');
            $table->string('kabupaten');
            $table->string('pekerjaan');
            $table->string('jns_kelamin');
            $table->string('alamat');
            $table->string('no_hp_pasien');
            $table->string('email_pasien');
            $table->string('gol_darah');
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
