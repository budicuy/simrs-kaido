<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Import Validator
use App\Models\Pendaftaran; // Import model Pendaftaran

class PendaftaranController extends Controller
{
    public function getMaxAntrian(Request $request)
    {
        // 1. Validasi Input dari Frontend
        // Pastikan frontend mengirim parameter id_poli dan tgl_kunjungan
        $validator = Validator::make($request->all(), [
            'id_poli' => 'required|integer|exists:polis,id', // 'exists' memastikan poli_id ada di tabel polis
            'tgl_kunjungan' => 'required|date_format:Y-m-d',
        ]);

        // Jika validasi gagal, kembalikan error
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Ambil data yang sudah divalidasi
        $validatedData = $validator->validated();
        $maxAntrian = Pendaftaran::where('id_poli', $validatedData['id_poli'])
                                 ->where('tgl_kunjungan', $validatedData['tgl_kunjungan'])
                                 ->max('no_antrian');
        return response()->json([
            'max_no_antrian' => $maxAntrian ? (int)$maxAntrian : 0
        ]);
    }
}
