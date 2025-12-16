<?php


namespace App\Http\Controllers;


use App\Models\KategoriDokumen;
use Illuminate\Http\Request;


class KategoriDokumenController extends Controller
{
    public function index()
    {
        $kategori = KategoriDokumen::all();
        return view('kategori_dokumen.index', compact('kategori'));
    }


    public function create()
    {
        return view('kategori_dokumen.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);


        KategoriDokumen::create($request->all());
        return redirect()->route('kategori-dokumen.index')
            ->with('success', 'Data berhasil disimpan');
    }


    public function edit($id)
    {
        $kategori = KategoriDokumen::findOrFail($id);
        return view('kategori_dokumen.edit', compact('kategori'));
    }


    public function update(Request $request, $id)
    {
        $kategori = KategoriDokumen::findOrFail($id);


        $request->validate([
            'nama' => 'required'
        ]);


        $kategori->update($request->all());
        return redirect()->route('kategori-dokumen.index')
            ->with('success', 'Data berhasil diupdate');
    }


    public function destroy($id)
    {
        KategoriDokumen::destroy($id);
        return redirect()->route('kategori-dokumen.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
