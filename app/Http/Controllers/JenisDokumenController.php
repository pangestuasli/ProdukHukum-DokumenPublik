<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use Illuminate\Http\Request;

class JenisDokumenController extends Controller
{
    public function index()
    {
        $data = JenisDokumen::all();
        return view('jenis_dokumen.index', compact('data'));
    }

    public function create()
    {
        return view('jenis_dokumen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jenis' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        JenisDokumen::create($validated);

        return redirect()
            ->route('jenis_dokumen.index')
            ->with('success', 'Jenis dokumen berhasil ditambahkan.');
    }

    public function edit(JenisDokumen $jenis_dokumen)
    {
        return view('jenis_dokumen.edit', compact('jenis_dokumen'));
    }

    public function update(Request $request, JenisDokumen $jenis_dokumen)
    {
        $validated = $request->validate([
            'nama_jenis' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $jenis_dokumen->update($validated);

        return redirect()
            ->route('jenis_dokumen.index')
            ->with('success', 'Jenis dokumen berhasil diperbarui.');
    }

    public function destroy(JenisDokumen $jenis_dokumen)
    {
        $jenis_dokumen->delete();

        return redirect()
            ->route('jenis_dokumen.index')
            ->with('success', 'Jenis dokumen berhasil dihapus.');
    }
}
