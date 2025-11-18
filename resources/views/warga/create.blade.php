@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Warga</h2>

    {{-- Flash Success --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Flash Error (Validasi dari controller) --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('warga.store') }}" method="POST">
        @csrf

        {{-- No KTP --}}
        <div class="mb-3">
            <label>No KTP</label>
            <input type="text" 
                   name="no_ktp" 
                   class="form-control @error('no_ktp') is-invalid @enderror" 
                   value="{{ old('no_ktp') }}" 
                   required>

            @error('no_ktp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nama --}}
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" 
                   name="nama" 
                   class="form-control @error('nama') is-invalid @enderror" 
                   value="{{ old('nama') }}" 
                   required>

            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Jenis Kelamin --}}
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" 
                    class="form-control @error('jenis_kelamin') is-invalid @enderror" 
                    required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>

            @error('jenis_kelamin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Agama --}}
        <div class="mb-3">
            <label>Agama</label>
            <input type="text" 
                   name="agama" 
                   class="form-control @error('agama') is-invalid @enderror" 
                   value="{{ old('agama') }}" 
                   required>

            @error('agama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Pekerjaan --}}
        <div class="mb-3">
            <label>Pekerjaan</label>
            <input type="text" 
                   name="pekerjaan" 
                   class="form-control @error('pekerjaan') is-invalid @enderror" 
                   value="{{ old('pekerjaan') }}">

            @error('pekerjaan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Telp --}}
        <div class="mb-3">
            <label>Telp</label>
            <input type="text" 
                   name="telp" 
                   class="form-control @error('telp') is-invalid @enderror" 
                   value="{{ old('telp') }}">

            @error('telp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label>Email</label>
            <input type="email" 
                   name="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   value="{{ old('email') }}">

            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tombol --}}
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('warga.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
