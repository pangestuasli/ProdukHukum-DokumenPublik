<?php

namespace App\Http\Controllers;

use App\Models\LampiranDokumen;
use Illuminate\Http\Request;

class LampiranDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = LampiranDokumen::with('dokumen');

        // Search berdasarkan nama file atau dokumen
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_file', 'like', '%' . $search . '%')
                  ->orWhereHas('dokumen', function($subQuery) use ($search) {
                      $subQuery->where('judul', 'like', '%' . $search . '%')
                               ->orWhere('nomor', 'like', '%' . $search . '%');
                  });
            });
        }

        $lampiran = $query->paginate(6);
        return view('lampiran_dokumen.index', compact('lampiran'));
    }
}
