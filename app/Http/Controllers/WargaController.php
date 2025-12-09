<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\WargaFile;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    // ===================== INDEX =====================
    public function index(Request $request)
    {
        $search = $request->input('search');

        $wargas = Warga::when($search, function($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                             ->orWhere('no_ktp', 'like', "%{$search}%");
            })
            ->orderBy('warga_id', 'ASC')
            ->paginate(5)
            ->withQueryString();

        return view('warga.index', compact('wargas'));
    }

    // ===================== CREATE =====================
    public function create()
    {
        return view('warga.create');
    }

    // ===================== STORE =====================
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
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'files.*'       => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Upload foto profil
        if ($request->hasFile('foto')) {
            $filename = time().'_'.$request->foto->getClientOriginalName();
            $request->foto->move(public_path('uploads/warga/foto'), $filename);
            $validated['foto'] = $filename;
        }

        $warga = Warga::create($validated);

        // Upload multiple files pendukung
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('uploads/warga/files'), $filename);
                $warga->files()->create(['file' => $filename]);
            }
        }

        return redirect()->route('warga.index')
                         ->with('success', 'Data warga berhasil ditambahkan.');
    }

    // ===================== EDIT =====================
    public function edit(Warga $warga)
{
    return view('warga.edit', compact('warga'));
}

public function update(Request $request, Warga $warga)
{
    $validated = $request->validate([
        'no_ktp' => 'required|max:20|unique:wargas,no_ktp,' . $warga->warga_id . ',warga_id',
        'nama' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'agama' => 'required|string|max:50',
        'pekerjaan' => 'nullable|string|max:100',
        'telp' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:100',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'files.*' => 'nullable|file|max:5120', // multiple file upload
    ]);

    // Update data warga
    $warga->update($validated);

    // Simpan foto profil (opsional)
    if ($request->hasFile('foto')) {
        $fileName = time() . '_' . $request->foto->getClientOriginalName();
        $request->foto->move(public_path('uploads/warga'), $fileName);
        $warga->update(['foto' => $fileName]);
    }

    // Simpan multiple files
    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/warga/files'), $fileName);

            $warga->files()->create([
                'file' => $fileName,
            ]);
        }
    }

    return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui.');
}


    // ===================== DESTROY =====================
    public function destroy(Warga $warga)
    {
        // Hapus foto profil
        if ($warga->foto && file_exists(public_path('uploads/warga/foto/'.$warga->foto))) {
            unlink(public_path('uploads/warga/foto/'.$warga->foto));
        }

        // Hapus file pendukung
        foreach ($warga->files as $file) {
            if (file_exists(public_path('uploads/warga/files/'.$file->file))) {
                unlink(public_path('uploads/warga/files/'.$file->file));
            }
            $file->delete();
        }

        $warga->delete();

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }

    // ===================== SHOW =====================
    public function show(Warga $warga)
    {
        $warga->load('files'); // load relasi multiple file
        return view('warga.show', compact('warga'));
    }
}
