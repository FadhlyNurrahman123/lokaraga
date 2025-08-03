<?php

use Illuminate\Support\Facades\Route;

// Publik
Route::view('/', 'welcome');
Route::view('/login', 'login');
Route::view('/register', 'register');

// Penyewa
Route::prefix('penyewa')->group(function () {
    Route::view('/beranda', 'penyewa.beranda');
    Route::view('/pesan', 'penyewa.pesan');
    Route::view('/pesan-lapangan', 'penyewa.pesan-lapangan');
    Route::get('/detail-lapangan/{id}', fn($id) => view('penyewa.detail-lapangan', ['id' => $id]));
    Route::view('/konfirm-pesan-lapangan', 'penyewa.konfirm-pesan-lapangan');
    Route::view('/riwayat', 'penyewa.riwayat');
    Route::get('/detail-riwayat/{id}', fn($id) => view('penyewa.detail-riwayat', ['id' => $id]));
    Route::view('/membership', 'penyewa.membership');
    Route::view('/pilihan-membership', 'penyewa.pilihan-membership');
    Route::view('/konfirm-membership', 'penyewa.konfirm-membership');
    Route::view('/akun', 'penyewa.akun');
});

// Pemilik
Route::prefix('pemilik')->group(function () {
    Route::view('/beranda', 'pemilik.beranda');
    Route::view('/kelola', 'pemilik.kelola');
    Route::view('/edit-lapangan', 'pemilik.edit-lapangan');
    Route::view('/riwayat', 'pemilik.riwayat');
    Route::get('/detail-riwayat/{id}', fn($id) => view('pemilik.detail-riwayat', ['id' => $id]));
    Route::view('/membership', 'pemilik.membership');
    Route::view('/tambah-membership', 'pemilik.tambah-membership');
    Route::get('/anggota-membership/{id}', fn($id) => view('pemilik.anggota-membership', ['id' => $id]));
    Route::get('/detail-membership/{id}', fn($id) => view('pemilik.detail-membership', ['id' => $id]));
    Route::view('/akun', 'pemilik.akun');
});

// Admin
Route::prefix('admin')->group(function () {
    Route::view('daftar-pemilik', 'admin.daftar-pemilik');
    Route::view('daftar-penyewa', 'admin.daftar-penyewa');
    Route::view('akun', 'admin.akun');
});