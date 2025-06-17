<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Pasiens;
use App\Models\Poli;
use App\Models\Pendaftaran; // Jika Anda memiliki model Pendaftaran
use App\Models\Perawat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getCounts(Request $request)
    {
        // Pastikan nama model di sini sesuai dengan model Anda
        $pendaftaranTotal = Pendaftaran::count(); // Gunakan ini jika ada tabel 'pendaftarans'
        $pasienTotal = Pasiens::count();
        $dokterTotal = Dokter::count();
        $poliTotal = Poli::count();
        $perawatTotal = Perawat::count();

        return response()->json([
            'pendaftaran_count' => $pendaftaranTotal,
            'pasien_count' => $pasienTotal,
            'poli_count' => $poliTotal,
            'dokter_count' => $dokterTotal,
            'perawat_count' => $perawatTotal,
        ]);
    }
}
