<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\Dokter;
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

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
