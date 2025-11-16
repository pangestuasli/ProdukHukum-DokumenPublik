<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;

Route::get('/', function () {
    return view('welcome');
});

route::get('/dashboard', [GuestController::class, 'index'])->name('dashboard');