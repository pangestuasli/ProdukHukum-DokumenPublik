<?php

namespace App\Http\Controllers;

use App\Models\LampiranDokumen;
use App\Models\DokumenHukum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LampiranDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lampiran = LampiranDokumen::with('dokumen')->get();
        return view('lampiran_dokumen.index', compact('lampiran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dokumen = DokumenHukum::all();
        return view('lampiran_dokumen.create', compact('dokumen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dokumen_id' => 'required|exists:dokumen_hukum,dokumen_id',
            'keterangan' => 'required|string',
            'media' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048'
        ]);

        $path = $request->file('media')->store('lampiran_dokumen', 'public');

        LampiranDokumen::create([
            'dokumen_id' => $request->dokumen_id,
            'keterangan' => $request->keterangan,
            'media' => $path
        ]);

        return redirect()->route('lampiran-dokumen.index')
            ->with('success', 'Lampiran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lampiran = LampiranDokumen::with('dokumen')->findOrFail($id);
        return view('lampiran_dokumen.show', compact('lampiran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lampiran = LampiranDokumen::findOrFail($id);
        $dokumen = DokumenHukum::all();
        return view('lampiran_dokumen.edit', compact('lampiran', 'dokumen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lampiran = LampiranDokumen::findOrFail($id);

        $request->validate([
            'dokumen_id' => 'required|exists:dokumen_hukum,dokumen_id',
            'keterangan' => 'required|string',
            'media' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048'
        ]);

        $data = [
            'dokumen_id' => $request->dokumen_id,
            'keterangan' => $request->keterangan
        ];

        if ($request->hasFile('media')) {
            // Hapus file lama
            Storage::disk('public')->delete($lampiran->media);
            $data['media'] = $request->file('media')->store('lampiran_dokumen', 'public');
        }

        $lampiran->update($data);

        return redirect()->route('lampiran-dokumen.index')
            ->with('success', 'Lampiran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lampiran = LampiranDokumen::findOrFail($id);
        Storage::disk('public')->delete($lampiran->media);
        $lampiran->delete();

        return redirect()->route('lampiran-dokumen.index')
            ->with('success', 'Lampiran berhasil dihapus');
    }
}
