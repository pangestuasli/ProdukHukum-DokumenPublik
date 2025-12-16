@extends('layouts.admin.app')


@section('title', 'Tambah Jenis Dokumen')


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Tambah Jenis Dokumen</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('jenis_dokumen.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Jenis</label>
                    <input type="text" name="nama_jenis" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control"></textarea>
                </div>
                <button class="btn btn-success mt-2">Simpan</button>
                <a href="{{ route('jenis_dokumen.index') }}" class="btn btn-secondary mt-2">Kembali</a>
            </form>
        </div>
    </div>
@endsection