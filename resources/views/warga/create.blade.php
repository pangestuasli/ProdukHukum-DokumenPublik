@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Warga</h2>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Validasi Error --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('warga.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Partial Form Fields --}}
        @include('warga.form-fields', ['warga' => null])

        {{-- Foto Profil --}}
        <div class="mb-3">
            <label class="form-label">Foto Profil</label>
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- File Pendukung (Multiple) --}}
        <div class="mb-3">
            <label class="form-label">Upload File Pendukung</label>
            <input type="file" name="files[]" multiple class="form-control @error('files.*') is-invalid @enderror">
            @error('files.*')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tombol --}}
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('warga.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
