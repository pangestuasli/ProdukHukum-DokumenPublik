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
    public function index(Request $request)
    {
        $query = RiwayatPerubahan::with('dokumenHukum');

        // Search berdasarkan deskripsi perubahan atau dokumen judul
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('deskripsi_perubahan', 'like', '%' . $search . '%')
                  ->orWhereHas('dokumenHukum', function($subQuery) use ($search) {
                      $subQuery->where('judul', 'like', '%' . $search . '%')
                               ->orWhere('nomor', 'like', '%' . $search . '%');
                  });
            });
        }

        $riwayat = $query->get();

        return view('riwayat_perubahan.index', compact('riwayat'));
    }
}
