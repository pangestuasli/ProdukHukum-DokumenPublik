<?php

namespace App\Http\Controllers;

use App\Models\KategoriDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query dasar dengan withCount untuk menghitung dokumen terkait
        $query = KategoriDokumen::withCount('dokumenHukum');
        
        // Filter pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }
        
        // Default sorting (terbaru)
        $query->orderBy('created_at', 'desc');
        
        // Pagination dengan per_page dinamis
        $perPage = $request->input('per_page', 10);
        $kategoriDokumen = $query->paginate($perPage)->appends($request->except('page'));
        
        return view('kategoridokumen.index', compact('kategoriDokumen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategoridokumen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100|unique:kategori_dokumen,nama',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        KategoriDokumen::create($request->all());

        return redirect()->route('kategori-dokumen.index')
            ->with('success', 'Kategori dokumen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriDokumen $kategoriDokumen)
    {
        // Load dengan jumlah dokumen terkait
        $kategoriDokumen->loadCount('dokumenHukum');
        return view('kategoridokumen.show', compact('kategoriDokumen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriDokumen $kategoriDokumen)
    {
        return view('kategoridokumen.edit', compact('kategoriDokumen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriDokumen $kategoriDokumen)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100|unique:kategori_dokumen,nama,' . $kategoriDokumen->kategori_id . ',kategori_id',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $kategoriDokumen->update($request->all());

        return redirect()->route('kategori-dokumen.index')
            ->with('success', 'Kategori dokumen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriDokumen $kategoriDokumen)
    {
        // Cek apakah kategori digunakan oleh dokumen
        if ($kategoriDokumen->dokumenHukum()->count() > 0) {
            return redirect()->route('kategori-dokumen.index')
                ->with('error', 'Tidak dapat menghapus kategori karena masih digunakan oleh dokumen.');
        }
        
        $kategoriDokumen->delete();

        return redirect()->route('kategori-dokumen.index')
            ->with('success', 'Kategori dokumen berhasil dihapus.');
    }
}