<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/beranda', function () {
    return view('berandaAdmin');
});

Route::get('/ppksMahasiswa', function () {
    return view('ppksMahasiswa');
});

Route::get('/buatLaporanMahasiswa', function () {
    return view('buatLaporanMahasiswa');
});

Route::get('/riwayatLaporanMahasiswa', function () {
    return view('riwayatLaporanMahasiswa');
});

Route::get('/BimbinganKonselingMahasiswa', function () {
    return view('BimbinganKonselingMahasiswa');
});

Route::get('/buatJadwalMahasiswa', function () {
    return view('buatJadwalMahasiswa');
});

Route::get('/riwayatKonselingMahasiswa', function () {
    return view('riwayatKonselingMahasiswa');
});

Route::get('/emosikuMahasiswa', function () {
    return view('emosikuMahasiswa');
});

Route::get('/buatCatatanMahasiswa', function () {
    return view('buatCatatanMahasiswa');
});

Route::get('/riwayatCatatanMahasiswa', function () {
    return view('riwayatCatatanMahasiswa');
});

Route::get('/profile', function () {
    return view('profile');
});

// Di routes/web.php atau routes/api.php
Route::post('/tanya-groq', [ChatbotController::class, 'tanyaGroq'])->name('chatbot.ask');