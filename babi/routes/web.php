<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KonselingController;


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

Route::get('/ppksadmin', function () {
    return view('ppks-admin');
});

Route::get('/emosikuadmin', function () {
    return view('emosiku-admin');
});

Route::get('/bkadmin', function () {
    return view('bk-admin');
});

Route::get('/artikeladmin', function () {
    return view('artikel-admin');
});

Route::get('/beranda,', function () {
    return view('berandaAdmin');
});

Route::get('/halaman', function () {
    return view('berandaPsikolog');
});

Route::get('/jadwalpsikolog', function () {
    return view('jadwalPsikolog');
});


Route::get('/caripasien', function () {
    return view('cariPasien');
});

Route::get('/konseling', function () {
    return view('konseling');
});

Route::get('/detailkonseling', [KonselingController::class, 'show'])->name('detailkonseling.show');