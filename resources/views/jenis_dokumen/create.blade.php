@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Jenis Dokumen</h2>

    {{-- FLASH MESSAGE --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('jenis_dokumen.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Jenis</label>
            <input 
                type="text" 
                name="nama_jenis" 
                class="form-control @error('nama_jenis') is-invalid @enderror"
                value="{{ old('nama_jenis') }}"
                required
            >
            @error('nama_jenis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea 
                name="deskripsi" 
                class="form-control @error('deskripsi') is-invalid @enderror"
            >{{ old('deskripsi') }}</textarea>

            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('jenis_dokumen.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
