<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use Illuminate\Http\Request;

class JenisDokumenController extends Controller
{
    public function index(Request $request)
    {
    
    {
        $search = $request->input('search');
        $filter = $request->input('filter'); // FILTER BARU

        $data = JenisDokumen::when($search, function ($query) use ($search) {
                return $query->where('nama_jenis', 'like', "%{$search}%")
                             ->orWhere('deskripsi', 'like', "%{$search}%");
            })
            ->when($filter, function ($query) use ($filter) {
                return $query->where('nama_jenis', $filter);
            })
            ->orderBy('jenis_id', 'ASC')
            ->paginate(5)
            ->withQueryString();

        // Untuk mengisi dropdown filter
        $listJenis = JenisDokumen::select('nama_jenis')->distinct()->get();

        return view('jenis_dokumen.index', compact('data', 'listJenis'));
    }

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
