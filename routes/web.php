<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisDokumenController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriDokumenController;
use App\Http\Controllers\DokumenHukumController;
use App\Http\Controllers\RiwayatPerubahanController;   
use App\Http\Controllers\WargaController;
use App\Http\Controllers\LampiranDokumenController;

Route::get('/', function () {
    return view('');
});

// Route tanpa login (guest)
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route yang butuh login
Route::middleware(['isLogin'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/api/dashboard/stats', [DashboardController::class, 'getDashboardStats'])->name('dashboard.stats');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Resource Routes yang umum
    Route::resource('jenis_dokumen', JenisDokumenController::class)
         ->parameters(['jenis_dokumen' => 'jenis_dokumen']);
    Route::resource('kategori-dokumen', KategoriDokumenController::class)->parameters([
        'kategori-dokumen' => 'kategoriDokumen'
    ]);
    Route::resource('warga', WargaController::class);
    Route::resource('dokumen-hukum', DokumenHukumController::class);
    Route::resource('lampiran-dokumen', LampiranDokumenController::class);
    Route::resource('riwayat-perubahan', RiwayatPerubahanController::class)->parameters(
        ['riwayat-perubahan' => 'riwayatPerubahan']);
    
    // Rute untuk file
    Route::prefix('dokumen-hukum/{dokumen}')->group(function () {
        Route::get('/file/{file}/download', [DokumenHukumController::class, 'downloadFile'])
            ->name('dokumen-hukum.file.download');
            
        Route::delete('/file/{file}', [DokumenHukumController::class, 'deleteFile'])
            ->name('dokumen-hukum.file.destroy');
    });
});

// Route khusus admin (pakai CheckRole)
Route::middleware(['isLogin', 'role:admin'])->group(function () {
    Route::resource('user', UserController::class);
    // route admin lainnya
});