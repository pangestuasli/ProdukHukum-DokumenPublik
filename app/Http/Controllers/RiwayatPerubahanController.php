<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\RiwayatPerubahan;
use App\Models\DokumenHukum;


class RiwayatPerubahanController extends Controller
{
    public function index($dokumen_id)
    {
        $dokumen = DokumenHukum::findOrFail($dokumen_id);
        $riwayat = RiwayatPerubahan::where('dokumen_id', $dokumen_id)->get();


        return view('riwayat_perubahan.index', compact('dokumen', 'riwayat'));
    }


    public function create($dokumen_id)
    {
        return view('riwayat_perubahan.create', compact('dokumen_id'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'dokumen_id' => 'required',
            'tanggal' => 'required|date',
            'uraian_perubahan' => 'required',
            'versi' => 'required'
        ]);


        RiwayatPerubahan::create($request->all());
        return redirect()->back()->with('success', 'Riwayat perubahan ditambahkan');
    }


    public function edit($id)
    {
        $riwayat = RiwayatPerubahan::findOrFail($id);
        return view('riwayat_perubahan.edit', compact('riwayat'));
    }


    public function update(Request $request, $id)
    {
        $riwayat = RiwayatPerubahan::findOrFail($id);
        $riwayat->update($request->all());


        return redirect()->back()->with('success', 'Riwayat diperbarui');
    }


    public function destroy($id)
    {
        RiwayatPerubahan::destroy($id);
        return redirect()->back()->with('success', 'Riwayat dihapus');
    }
}