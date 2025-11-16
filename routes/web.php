<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\JenisDokumenController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [GuestController::class, 'index'])->name('dashboard');

Route::resource('warga', WargaController::class);
Route::resource('jenis-dokumen', JenisDokumenController::class);