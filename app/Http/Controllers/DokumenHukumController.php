<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenHukum;
use App\Models\JenisDokumen;      
use App\Models\KategoriDokumen;   

class DokumenHukumController extends Controller
{
    public function index()
    {
        $jenis = JenisDokumen::all();
        $kategori = KategoriDokumen::all();
        return view('dokumen_hukum.create', compact('jenis', 'kategori'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'jenis_id' => 'required',
            'kategori_id' => 'required',
            'nomor' => 'required|unique:dokumen_hukum,nomor',
            'judul' => 'required',
            'tanggal' => 'required|date',
            'file_dokumen' => 'nullable|mimes:pdf,doc,docx|max:2048'
        ]);


        $data = $request->all();


        if ($request->hasFile('file_dokumen')) {
            $data['file_dokumen'] = $request->file('file_dokumen')
                ->store('dokumen_hukum', 'public');
        }


        DokumenHukum::create($data);
        return redirect()->route('dokumen-hukum.index')->with('success', 'Data berhasil disimpan');
    }


    public function edit($id)
    {
        $dokumen = DokumenHukum::findOrFail($id);
        $jenis = JenisDokumen::all();
        $kategori = KategoriDokumen::all();
        return view('dokumen_hukum.edit', compact('dokumen', 'jenis', 'kategori'));
    }


    public function update(Request $request, $id)
    {
        $dokumen = DokumenHukum::findOrFail($id);


        $request->validate([
            'nomor' => 'required|unique:dokumen_hukum,nomor,' . $dokumen->dokumen_id . ',dokumen_id',
            'judul' => 'required'
        ]);


        $data = $request->all();


        if ($request->hasFile('file_dokumen')) {
            if ($dokumen->file_dokumen) {
                Storage::disk('public')->delete($dokumen->file_dokumen);
            }
            $data['file_dokumen'] = $request->file('file_dokumen')
                ->store('dokumen_hukum', 'public');
        }


        $dokumen->update($data);
        return redirect()->route('dokumen-hukum.index')->with('success', 'Data berhasil diupdate');
    }


    public function destroy($id)
    {
        $dokumen = DokumenHukum::findOrFail($id);
        if ($dokumen->file_dokumen) {
            Storage::disk('public')->delete($dokumen->file_dokumen);
        }
        $dokumen->delete();
        return redirect()->route('dokumen-hukum.index')->with('success', 'Data berhasil dihapus');
    }
}
