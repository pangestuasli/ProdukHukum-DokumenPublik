<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\JenisDokumen;
use App\Models\KategoriDokumen;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class DokumenHukumController extends Controller
{
    // ========== INDEX ==========
    public function index()
    {
        // Load dengan file utama saja
        $dokumenHukum = DokumenHukum::with(['jenisDokumen', 'kategoriDokumen', 'fileUtama'])
            ->orderBy('tanggal', 'desc')
            ->paginate(10);
            
        return view('dokumenhukum.index', compact('dokumenHukum'));
    }

    // ========== CREATE ==========
    public function create()
    {
        $jenisDokumen = JenisDokumen::orderBy('nama_jenis')->get();
        $kategoriDokumen = KategoriDokumen::orderBy('nama')->get();
        
        return view('dokumenhukum.create', compact('jenisDokumen', 'kategoriDokumen'));
    }

    // ========== STORE ==========
    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'jenis_id' => 'required|exists:jenis_dokumen,jenis_id',
            'kategori_id' => 'required|exists:kategori_dokumen,kategori_id',
            'nomor' => 'required|string|max:100|unique:dokumen_hukum,nomor',
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'ringkasan' => 'nullable|string',
            'status' => 'required|in:draft,publik,arsip',
            'file_utama' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // 1. SIMPAN DOKUMEN
        $dokumen = DokumenHukum::create($request->except('file_utama'));

        // 2. SIMPAN FILE
        if ($request->hasFile('file_utama')) {
            $file = $request->file('file_utama');
            
            // Nama file unik
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            // Simpan ke storage
            $path = $file->storeAs('dokumen', $fileName, 'public');
            
            // Simpan ke database
            Media::create([
                'ref_table' => 'dokumen_hukum',
                'ref_id' => $dokumen->dokumen_id,
                'file_url' => $path,
                'caption' => 'File Utama - ' . $dokumen->judul,
                'mime_type' => $file->getMimeType(),
                'sort_order' => 0
            ]);
        }

        return redirect()->route('dokumen-hukum.index')
            ->with('success', 'Dokumen berhasil ditambahkan!');
    }

    // ========== SHOW ==========
    public function show($id)
    {
        $dokumenHukum = DokumenHukum::with([
                'jenisDokumen', 
                'kategoriDokumen', 
                'files'  // Load semua file
            ])->findOrFail($id);
            
        return view('dokumenhukum.show', compact('dokumenHukum'));
    }

    // ========== EDIT ==========
    public function edit($id)
    {
        $dokumenHukum = DokumenHukum::with('files')->findOrFail($id);
        $jenisDokumen = JenisDokumen::orderBy('nama_jenis')->get();
        $kategoriDokumen = KategoriDokumen::orderBy('nama')->get();
        
        return view('dokumenhukum.edit', compact('dokumenHukum', 'jenisDokumen', 'kategoriDokumen'));
    }

    // ========== UPDATE ==========
    public function update(Request $request, $id)
    {
        $dokumen = DokumenHukum::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'jenis_id' => 'required|exists:jenis_dokumen,jenis_id',
            'kategori_id' => 'required|exists:kategori_dokumen,kategori_id',
            'nomor' => 'required|string|max:100|unique:dokumen_hukum,nomor,' . $id . ',dokumen_id',
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'ringkasan' => 'nullable|string',
            'status' => 'required|in:draft,publik,arsip',
            'file_utama' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update dokumen
        $dokumen->update($request->except('file_utama'));

        // Update file jika ada
        if ($request->hasFile('file_utama')) {
            // Hapus file lama jika ada
            $fileLama = $dokumen->fileUtama;
            if ($fileLama) {
                Storage::disk('public')->delete($fileLama->file_url);
                $fileLama->delete();
            }
            
            // Upload file baru
            $file = $request->file('file_utama');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('dokumen', $fileName, 'public');
            
            Media::create([
                'ref_table' => 'dokumen_hukum',
                'ref_id' => $dokumen->dokumen_id,
                'file_url' => $path,
                'caption' => 'File Utama - ' . $dokumen->judul,
                'mime_type' => $file->getMimeType(),
                'sort_order' => 0
            ]);
        }

        return redirect()->route('dokumen-hukum.index')
            ->with('success', 'Dokumen berhasil diperbarui!');
    }

    // ========== DESTROY ==========
    public function destroy($id)
    {
        $dokumen = DokumenHukum::with('files')->findOrFail($id);
        
        // Hapus semua file
        foreach ($dokumen->files as $file) {
            Storage::disk('public')->delete($file->file_url);
            $file->delete();
        }
        
        // Hapus dokumen
        $dokumen->delete();

        return redirect()->route('dokumen-hukum.index')
            ->with('success', 'Dokumen berhasil dihapus!');
    }

    // ========== DOWNLOAD FILE ==========
    public function downloadFile($dokumenId, $fileId)
    {
        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'dokumen_hukum')
            ->where('ref_id', $dokumenId)
            ->firstOrFail();
            
        $path = storage_path('app/public/' . $file->file_url);
        
        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }
        
        return response()->download($path, basename($file->file_url));
    }

    // ========== DELETE FILE ==========
    public function deleteFile($dokumenId, $fileId)
    {
        $file = Media::where('media_id', $fileId)
            ->where('ref_table', 'dokumen_hukum')
            ->where('ref_id', $dokumenId)
            ->firstOrFail();
            
        Storage::disk('public')->delete($file->file_url);
        $file->delete();

        return redirect()->back()
            ->with('success', 'File berhasil dihapus');
    }
}