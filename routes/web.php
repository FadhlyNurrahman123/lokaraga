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

Route::get('/detail-riwayat', function () {
    return view('detail-riwayat');
});

Route::get('/akun', function () {
    return view('akun');
});