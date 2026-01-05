<?php

use App\Models\KategoriDokumen;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\JenisDokumenController;
use App\Http\Controllers\KategoriDokumenController;
use App\Http\Controllers\DokumenHukumController;    
use App\Http\Controllers\RiwayatPerubahanController;
use App\Http\Controllers\LampiranDokumenController;

Route::get('/', function () {
    return view('dashboard');
});

route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
Route::resource('warga', WargaController::class);
Route::resource('jenis_dokumen', JenisDokumenController::class);
Route::resource('kategori-dokumen', KategoriDokumenController::class);
Route::resource('dokumen-hukum', DokumenHukumController::class);

Route::resource('lampiran-dokumen', LampiranDokumenController::class);


Route::get('/riwayat-perubahan', [RiwayatPerubahanController::class, 'index'])
    ->name('riwayat-perubahan.index');



