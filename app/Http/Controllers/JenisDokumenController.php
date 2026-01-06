<?php


namespace App\Http\Controllers;


use App\Models\JenisDokumen;
use Illuminate\Http\Request;


class JenisDokumenController extends Controller
{
    public function index(Request $request)
    {
        $query = JenisDokumen::query();

        // Search berdasarkan nama_jenis
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_jenis', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
        }

        $jenis = $query->paginate(4);
        return view('jenis_dokumen.index', compact('jenis'));
    }


    public function create()
    {
        return view('jenis_dokumen.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|unique:jenis_dokumen,nama_jenis',
            'deskripsi' => 'nullable'
        ]);


        JenisDokumen::create($request->all());
        return redirect()->route('jenis_dokumen.index')->with('success', 'Data berhasil disimpan');
    }


    public function edit($id)
    {
        $jenis = JenisDokumen::findOrFail($id);
        return view('jenis_dokumen.edit', compact('jenis'));
    }


    public function update(Request $request, $id)
    {
        $jenis = JenisDokumen::findOrFail($id);


        $request->validate([
            'nama_jenis' => 'required|unique:jenis_dokumen,nama_jenis,' . $jenis->jenis_id . ',jenis_id'
        ]);


        $jenis->update($request->all());
        return redirect()->route('jenis_dokumen.index')->with('success', 'Data berhasil diupdate');
    }


    public function destroy($id)
    {
        JenisDokumen::destroy($id);
        return redirect()->route('jenis_dokumen.index')->with('success', 'Data berhasil dihapus');
    }
}