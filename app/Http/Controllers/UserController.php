<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter berdasarkan role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        // Search berdasarkan nama atau email
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Pagination dengan appends untuk mempertahankan filter
        $data['dataUser'] = $query->paginate(5)->appends($request->except('page'));
        
        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi
        $request->validate(User::storeRules());
        
        // Handle upload gambar
        $profilPicture = null;
        if ($request->hasFile('profil_picture')) {
            $file = $request->file('profil_picture');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Simpan file di storage
            $file->storeAs('public/profil', $fileName);
            $profilPicture = $fileName;
        }
        
        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'profil_picture' => $profilPicture,
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['user'] = User::findOrFail($id);
        return view('user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataUser'] = User::findOrFail($id);
        return view('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        
        // Validasi
        $request->validate(User::updateRules($id));
        
        // Handle upload gambar
        if ($request->hasFile('profil_picture')) {
            // Hapus file lama jika ada
            if ($user->profil_picture && Storage::exists('public/profil/' . $user->profil_picture)) {
                Storage::delete('public/profil/' . $user->profil_picture);
            }
            
            // Upload file baru
            $file = $request->file('profil_picture');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profil', $fileName);
            $user->profil_picture = $fileName;
        }
        
        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role ?? $user->role;
        
        // Jika password diisi → update, kalau tidak → biarkan
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        
        // Hapus foto profil jika ada
        if ($user->profil_picture && Storage::exists('public/profil/' . $user->profil_picture)) {
            Storage::delete('public/profil/' . $user->profil_picture);
        }
        
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }
}