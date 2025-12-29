<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        $wargas = Warga::orderBy('nama')->paginate(10);
        return view('warga.index', compact('wargas'));
    }

    public function create()
    {
        return view('warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required|unique:wargas|size:16',
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'required|max:15',
            'email' => 'nullable|email|unique:wargas'
        ]);

        Warga::create($request->all());

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function show(Warga $warga)
    {
        return view('warga.show', compact('warga'));
    }

    public function edit(Warga $warga)
    {
        return view('warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $request->validate([
            'no_ktp' => 'required|size:16|unique:wargas,no_ktp,' . $warga->warga_id . ',warga_id',
            'nama' => 'required|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'required|max:15',
            'email' => 'nullable|email|unique:wargas,email,' . $warga->warga_id . ',warga_id'
        ]);

        $warga->update($request->all());

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil dihapus.');
    }
}