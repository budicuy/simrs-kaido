<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Perawat;
use App\Models\Poli;
use App\Models\Pasiens;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        // Create sample user for dokter and perawat
        $user1 = User::firstOrCreate(['email' => 'dokter@test.com'], [
            'name' => 'Dr. Test',
            'password' => bcrypt('password')
        ]);

        $user2 = User::firstOrCreate(['email' => 'perawat@test.com'], [
            'name' => 'Perawat Test',
            'password' => bcrypt('password')
        ]);

        // Create sample dokter
        $dokter = Dokter::firstOrCreate(['id_user' => $user1->id], [
            'nama_dokter' => 'Dr. Test',
            'no_hp_dokter' => '081234567890'
        ]);

        // Create sample perawat
        $perawat = Perawat::firstOrCreate(['id_user' => $user2->id], [
            'nama_perawat' => 'Perawat Test',
            'no_hp_perawat' => '081234567891'
        ]);

        // Create sample poli
        $poli = Poli::firstOrCreate(['nama_poli' => 'Poli Umum'], [
            'id_dokter' => $dokter->id,
            'id_perawat' => $perawat->id
        ]);

        // Create sample pasien
        $pasien = Pasiens::firstOrCreate(['rm' => 1001], [
            'nik' => 1234567890123456,
            'nama_pasien' => 'John Doe',
            'tgl_lahir' => '1990-01-01',
            'agama' => 'Islam',
            'kabupaten' => 'Kota Banjarmasin',
            'pekerjaan' => 'Karyawan',
            'jns_kelamin' => 'Laki-Laki',
            'alamat' => 'Jl. Test No. 1',
            'no_hp_pasien' => '081234567892',
            'email_pasien' => 'john@test.com',
            'gol_darah' => 'A'
        ]);

        $this->command->info('Sample data created successfully!');
        $this->command->info('Pasien RM: ' . $pasien->rm);
        $this->command->info('Poli ID: ' . $poli->id);
    }
}
