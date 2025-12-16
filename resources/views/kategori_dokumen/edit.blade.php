@extends('layouts.admin.app')


@section('title', 'Edit Kategori Dokumen')


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit Kategori Dokumen</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('kategori-dokumen.update', $kategori->kategori_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama" value="{{ $kategori->nama }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control">{{ $kategori->deskripsi }}</textarea>
                </div>
                <button class="btn btn-success mt-2">Update</button>
                <a href="{{ route('kategori-dokumen.index') }}" class="btn btn-secondary mt-2">Kembali</a>
            </form>
        </div>
    </div>
@endsection