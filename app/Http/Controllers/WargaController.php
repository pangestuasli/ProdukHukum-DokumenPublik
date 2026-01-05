<?php

namespace App\Http\Controllers;
use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        $wargas = Warga::all();
        return view('warga.index', compact('wargas'));
    }


    public function create()
    {
        return view('warga.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp',
            'nama' => 'required',
            'jenis_kelamin' => 'required'
        ]);


        Warga::create($request->all());
        return redirect()->route('warga.index')->with('success', 'Data berhasil disimpan');
    }


    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('warga.edit', compact('warga'));
    }


    public function update(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);


        $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp,' . $warga->warga_id . ',warga_id',
            'nama' => 'required'
        ]);


        $warga->update($request->all());
        return redirect()->route('warga.index')->with('success', 'Data berhasil diupdate');
    }


    public function destroy($id)
    {
        Warga::destroy($id);
        return redirect()->route('warga.index')->with('success', 'Data berhasil dihapus');
    }
}