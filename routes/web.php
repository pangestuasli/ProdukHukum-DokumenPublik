<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisDokumenController;
use App\Http\Controllers\WargaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});



Route::resource('jenis_dokumen', JenisDokumenController::class)
     ->parameters(['jenis_dokumen' => 'jenis_dokumen']);



Route::resource('warga', WargaController::class)
    ->parameters(['warga' => 'warga']);
