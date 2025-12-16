<?php

use App\Models\KategoriDokumen;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\JenisDokumenController;
use App\Http\Controllers\KategoriDokumenController;
use App\Http\Controllers\DokumenHukumController;    
use App\Http\Controllers\RiwayatPerubahanController;

Route::get('/', function () {
    return view('welcome');
});

route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
Route::resource('warga', WargaController::class);
Route::resource('jenis_dokumen', JenisDokumenController::class);
Route::resource('kategori-dokumen', KategoriDokumenController::class);
Route::resource('dokumen-hukum', DokumenHukumController::class);
Route::get(
    'dokumen-hukum/{dokumen_id}/riwayat',
    [RiwayatPerubahanController::class, 'index']
)->name('riwayat-perubahan.index');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');