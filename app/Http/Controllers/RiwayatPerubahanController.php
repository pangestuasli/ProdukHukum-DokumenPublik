<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPerubahan;
use App\Models\DokumenHukum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RiwayatPerubahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = RiwayatPerubahan::with('dokumenHukum')
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc');

        // Filter by document if provided
        if ($request->has('dokumen_id')) {
            $query->where('dokumen_id', $request->dokumen_id);
        }

        $riwayatPerubahan = $query->paginate(10);
        
        // Get documents for filter dropdown
        $dokumenList = DokumenHukum::orderBy('judul')->get();

        return view('riwayatperubahan.index', compact('riwayatPerubahan', 'dokumenList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $dokumenList = DokumenHukum::orderBy('judul')->get();
        $selectedDokumen = $request->dokumen_id;

        return view('riwayatperubahan.create', compact('dokumenList', 'selectedDokumen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dokumen_id' => 'required|exists:dokumen_hukum,dokumen_id',
            'tanggal' => 'required|date',
            'uraian_perubahan' => 'required|string',
            'versi' => 'nullable|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Get next version if not provided
        if (!$request->versi) {
            $request->merge(['versi' => RiwayatPerubahan::getNextVersion($request->dokumen_id)]);
        }

        RiwayatPerubahan::create($request->all());

        return redirect()->route('riwayat-perubahan.index')
            ->with('success', 'Riwayat perubahan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $riwayatPerubahan = RiwayatPerubahan::with('dokumenHukum')->findOrFail($id);
        
        return view('riwayatperubahan.show', compact('riwayatPerubahan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $riwayatPerubahan = RiwayatPerubahan::findOrFail($id);
        $dokumenList = DokumenHukum::orderBy('judul')->get();

        return view('riwayatperubahan.edit', compact('riwayatPerubahan', 'dokumenList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'dokumen_id' => 'required|exists:dokumen_hukum,dokumen_id',
            'tanggal' => 'required|date',
            'uraian_perubahan' => 'required|string',
            'versi' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $riwayatPerubahan = RiwayatPerubahan::findOrFail($id);
        $riwayatPerubahan->update($request->all());

        return redirect()->route('riwayat-perubahan.index')
            ->with('success', 'Riwayat perubahan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $riwayatPerubahan = RiwayatPerubahan::findOrFail($id);
        $riwayatPerubahan->delete();

        return redirect()->route('riwayat-perubahan.index')
            ->with('success', 'Riwayat perubahan berhasil dihapus.');
    }    
}