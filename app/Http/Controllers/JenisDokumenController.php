<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JenisDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisDokumen = JenisDokumen::latest()->get();
        return view('guest.JenisDokumen.index', compact('jenisDokumen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guest.JenisDokumen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jenis' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto_path'] = $request->file('foto')->store('jenis-dokumen', 'public');
        }

        JenisDokumen::create($validated);

        return redirect()->route('jenis-dokumen.index')
            ->with('success', 'Jenis dokumen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jenisDokumen = JenisDokumen::findOrFail($id);
        return view('guest.JenisDokumen.show', compact('jenisDokumen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jenisDokumen = JenisDokumen::findOrFail($id);
        return view('guest.JenisDokumen.edit', compact('jenisDokumen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jenisDokumen = JenisDokumen::findOrFail($id);

        $validated = $request->validate([
            'nama_jenis' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($jenisDokumen->foto_path) {
                Storage::disk('public')->delete($jenisDokumen->foto_path);
            }
            $validated['foto_path'] = $request->file('foto')->store('jenis-dokumen', 'public');
        }

        $jenisDokumen->update($validated);

        return redirect()->route('jenis-dokumen.index')
            ->with('success', 'Jenis dokumen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenisDokumen = JenisDokumen::findOrFail($id);

        if ($jenisDokumen->foto_path) {
            Storage::disk('public')->delete($jenisDokumen->foto_path);
        }

        $jenisDokumen->delete();

        return redirect()->route('jenis-dokumen.index')
            ->with('success', 'Jenis dokumen berhasil dihapus.');
    }
}
