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
    public function index()
    {
        $kategoriDokumen = KategoriDokumen::all();
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
            'nama' => 'required|string|max:100',
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
            'nama' => 'required|string|max:100',
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
        $kategoriDokumen->delete();

        return redirect()->route('kategori-dokumen.index')
            ->with('success', 'Kategori dokumen berhasil dihapus.');
    }
}