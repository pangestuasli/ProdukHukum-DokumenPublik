<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\JenisDokumen;
use App\Models\KategoriDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DokumenHukumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokumenHukum = DokumenHukum::with(['jenisDokumen', 'kategoriDokumen'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('dokumenhukum.index', compact('dokumenHukum'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisDokumen = JenisDokumen::orderBy('nama_jenis')->get();
        $kategoriDokumen = KategoriDokumen::orderBy('nama')->get();
        
        return view('dokumenhukum.create', compact('jenisDokumen', 'kategoriDokumen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_id' => 'required|exists:jenis_dokumen,jenis_id',
            'kategori_id' => 'required|exists:kategori_dokumen,kategori_id',
            'nomor' => 'required|string|max:100',
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'ringkasan' => 'nullable|string',
            'status' => 'required|in:draft,publik,arsip',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DokumenHukum::create($request->all());

        return redirect()->route('dokumen-hukum.index')
            ->with('success', 'Dokumen hukum berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dokumenHukum = DokumenHukum::with(['jenisDokumen', 'kategoriDokumen'])
            ->findOrFail($id);
            
        return view('dokumenhukum.show', compact('dokumenHukum'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dokumenHukum = DokumenHukum::findOrFail($id);
        $jenisDokumen = JenisDokumen::orderBy('nama_jenis')->get();
        $kategoriDokumen = KategoriDokumen::orderBy('nama')->get();
        
        return view('dokumenhukum.edit', compact('dokumenHukum', 'jenisDokumen', 'kategoriDokumen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jenis_id' => 'required|exists:jenis_dokumen,jenis_id',
            'kategori_id' => 'required|exists:kategori_dokumen,kategori_id',
            'nomor' => 'required|string|max:100',
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'ringkasan' => 'nullable|string',
            'status' => 'required|in:draft,publik,arsip',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $dokumenHukum = DokumenHukum::findOrFail($id);
        $dokumenHukum->update($request->all());

        return redirect()->route('dokumen-hukum.index')
            ->with('success', 'Dokumen hukum berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dokumenHukum = DokumenHukum::findOrFail($id);
        $dokumenHukum->delete();

        return redirect()->route('dokumen-hukum.index')
            ->with('success', 'Dokumen hukum berhasil dihapus.');
    }
}