<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisDokumenController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('jenis_dokumen', JenisDokumenController::class)
     ->parameters(['jenis_dokumen' => 'jenis_dokumen']);

Route::resource('user', UserController::class);
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::resource('warga', WargaController::class)
    ->parameters(['warga' => 'warga']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route tanpa login (guest)
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route yang butuh login (pakai CheckIsLogin)
Route::middleware(['isLogin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Route khusus admin (pakai CheckRole)
Route::middleware(['isLogin', 'role:admin'])->group(function () {
    Route::resource('user', UserController::class);
    // route admin lainnya
});

// Route khusus user biasa
Route::middleware(['isLogin', 'role:user'])->group(function () {
    // Route untuk user biasa di sini
});
