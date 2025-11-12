@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Jenis Dokumen</h2>
    <form action="{{ route('jenis_dokumen.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Jenis</label>
            <input type="text" name="nama_jenis" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('jenis_dokumen.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
