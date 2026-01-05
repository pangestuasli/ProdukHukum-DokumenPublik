<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPerubahan;
use App\Models\DokumenHukum;
use Illuminate\Http\Request;

class RiwayatPerubahanController extends Controller
{
    /**
     * Tampilkan riwayat perubahan per dokumen
     */
    public function index()
    {
        $riwayat = RiwayatPerubahan::with('dokumenHukum')->get();

    return view('riwayat_perubahan.index', compact('riwayat'));
    }
}
