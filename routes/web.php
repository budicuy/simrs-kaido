<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\AuthController;
Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/poli', function () {
    return view('poli');
})->name('poli');

Route::get('/perawat', function () {
    return view('perawat');
})->name('perawat');

Route::get('/dokter', function () {
    return view('dokter');
})->name('dokter');

Route::get('/pendaftaran', function () {
    return view('pendaftaran.index');
})->name('pendaftaran');

Route::get('/pendaftaran/riwayat', function () {
    return view('pendaftaran.riwayat');
})->name('pendaftaran.riwayat');

Route::get('/pendaftaran/tambah', function () {
    return view('pendaftaran.tambah');
})->name('pendaftaran.tambah');

Route::get('/pasien', function () {
    return view('pasien.index');
})->name('pasien');

Route::get('/pasien/tambah', function () {
    return view('pasien.tambah');
})->name('pasien.tambah');

// routes/web.php

// Route untuk menampilkan halaman detail pasien berdasarkan RM
Route::get('/pasien/detail/{rm}', function ($rm) {
    // Melempar variabel $rm ke dalam view 'pasien.detail'
    return view('pasien.detail', ['rm' => $rm]);
})->name('pasien.detail');

// Route untuk menampilkan halaman edit pasien berdasarkan RM
Route::get('/pasien/edit/{rm}', function ($rm) {
    // Melempar variabel $rm ke dalam view 'pasien.edit'
    return view('pasien.edit', ['rm' => $rm]);
})->name('pasien.edit');

Route::get('/dashboard/counts', [DashboardController::class, 'getCounts']);
