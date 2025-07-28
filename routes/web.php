<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/pesan', function () {
    return view('pesan');
});

Route::get('/pesan-lapangan', function () {
    return view('pesan-lapangan');
});

Route::get('/detail-lapangan/{id}', function ($id) {
    return view('detail-lapangan', ['id' => $id]);
});

Route::get('/konfirm-pesan-lapangan', function () {
    return view('konfirm-pesan-lapangan');
});

Route::get('/riwayat', function () {
    return view('riwayat');
});

Route::get('/detail-riwayat/{id}', function ($id) {
    return view('detail-riwayat', ['id' => $id]);
});

Route::get('/membership', function () {
    return view('membership');
});

Route::get('/pilihan-membership', function () {
    return view('pilihan-membership');
});

Route::get('/konfirm-membership', function () {
    return view('konfirm-membership');
});

Route::get('/akun', function () {
    return view('akun');
});

Route::get('/beranda-pemilik', function () {
    return view('beranda-pemilik');
});

Route::get('/beranda-admin', function () {
    return view('beranda-admin');
});