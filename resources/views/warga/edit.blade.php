@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Warga</h2>

    {{-- Error global --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('warga.update', $warga->warga_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Data Pribadi --}}
        @include('warga.form-fields', ['warga' => $warga])

        {{-- Foto Profil --}}
        <div class="mb-3">
            <label class="form-label">Foto Profil</label>
            @if($warga->foto)
                <div class="mb-2">
                    <img src="{{ asset('uploads/warga/foto/'.$warga->foto) }}" width="120">
                </div>
            @endif
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- File Pendukung (Multiple) --}}
        <div class="mb-3">
            <label class="form-label">File Pendukung</label>

            @if($warga->files->count() > 0)
                <ul class="mb-2">
                    @foreach($warga->files as $file)
                        <li>
                            <a href="{{ asset('uploads/warga/files/'.$file->file) }}" target="_blank">{{ $file->file }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif

            <input type="file" name="files[]" multiple class="form-control @error('files.*') is-invalid @enderror">
            @error('files.*')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="d-flex justify-content-between">
            <a href="{{ route('warga.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Perbarui</button>
        </div>
    </form>
</div>
@endsection
