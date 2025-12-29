<?php
// app/Http/Controllers/LampiranDokumenController.php

namespace App\Http\Controllers;

use App\Models\LampiranDokumen;
use App\Models\DokumenHukum; // Ubah ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LampiranDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lampiran = LampiranDokumen::with('dokumenHukum') // Ubah ini
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $dokumenList = DokumenHukum::all(); // Ubah ini

        return view('lampirandokumen.index', compact('lampiran', 'dokumenList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dokumenList = DokumenHukum::all(); // Ubah ini
        return view('lampirandokumen.create', compact('dokumenList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dokumen_id' => 'required|exists:dokumen_hukum,dokumen_id', // Ubah ini
            'berkas_lampiran' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx|max:2048',
            'keterangan' => 'nullable|string|max:500',
        ]);

        // Upload file
        if ($request->hasFile('berkas_lampiran')) {
            $file = $request->file('berkas_lampiran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('lampiran', $fileName, 'public');
            
            $validated['berkas_lampiran'] = $fileName;
        }

        LampiranDokumen::create($validated);

        return redirect()->route('lampiran-dokumen.index')
            ->with('success', 'Lampiran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lampiran = LampiranDokumen::with('dokumenHukum')->findOrFail($id); // Ubah ini
        return view('lampirandokumen.show', compact('lampiran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lampiran = LampiranDokumen::findOrFail($id);
        $dokumenList = DokumenHukum::all(); // Ubah ini
        
        return view('lampirandokumen.edit', compact('lampiran', 'dokumenList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $lampiran = LampiranDokumen::findOrFail($id);

        $validated = $request->validate([
            'dokumen_id' => 'required|exists:dokumen_hukum,dokumen_id', // Ubah ini
            'berkas_lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx|max:2048',
            'keterangan' => 'nullable|string|max:500',
        ]);

        // Jika ada file baru diupload
        if ($request->hasFile('berkas_lampiran')) {
            // Hapus file lama
            if ($lampiran->berkas_lampiran) {
                Storage::disk('public')->delete('lampiran/' . $lampiran->berkas_lampiran);
            }

            // Upload file baru
            $file = $request->file('berkas_lampiran');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('lampiran', $fileName, 'public');
            
            $validated['berkas_lampiran'] = $fileName;
        } else {
            // Jika tidak ada file baru, pertahankan file lama
            unset($validated['berkas_lampiran']);
        }

        $lampiran->update($validated);

        return redirect()->route('lampirandokumen.index')
            ->with('success', 'Lampiran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lampiran = LampiranDokumen::findOrFail($id);

        // Hapus file dari storage
        if ($lampiran->berkas_lampiran) {
            Storage::disk('public')->delete('lampiran/' . $lampiran->berkas_lampiran);
        }

        $lampiran->delete();

        return redirect()->route('lampirandokumen.index')
            ->with('success', 'Lampiran berhasil dihapus.');
    }

    /**
     * Download file lampiran
     */
    public function download($id)
    {
        $lampiran = LampiranDokumen::findOrFail($id);
        $filePath = storage_path('app/public/lampiran/' . $lampiran->berkas_lampiran);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return response()->download($filePath);
    }
}