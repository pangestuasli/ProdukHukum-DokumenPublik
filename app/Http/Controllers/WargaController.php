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
         $validated = $request->validate([
        'no_ktp'        => 'required|unique:wargas,no_ktp|max:20',
        'nama'          => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'agama'         => 'required|string|max:50',
        'pekerjaan'     => 'nullable|string|max:100',
        'telp'          => 'nullable|string|max:20',
        'email'         => 'nullable|email|max:100',
    ]);

    Warga::create($validated);

    return redirect()
        ->route('warga.index')
        ->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function edit(Warga $warga)
    {
        return view('warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $validated = $request->validate([
        'no_ktp'        => 'required|max:20|unique:wargas,no_ktp,' . $warga->warga_id . ',warga_id',
        'nama'          => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'agama'         => 'required|string|max:50',
        'pekerjaan'     => 'nullable|string|max:100',
        'telp'          => 'nullable|string|max:20',
        'email'         => 'nullable|email|max:100',
    ]);

    $warga->update($validated);

    return redirect()
        ->route('warga.index')
        ->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }

    public function show(Warga $warga)
    {
        return view('warga.show', compact('warga'));
    }
}
