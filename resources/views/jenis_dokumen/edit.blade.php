@extends('layouts.admin.app')


@section('title', 'Edit Jenis Dokumen')


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit Jenis Dokumen</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('jenis-dokumen.update', $jenis->jenis_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Jenis</label>
                    <input type="text" name="nama_jenis" value="{{ $jenis->nama_jenis }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control">{{ $jenis->deskripsi }}</textarea>
                </div>
                <button class="btn btn-success mt-2">Update</button>
                <a href="{{ route('jenis-dokumen.index') }}" class="btn btn-secondary mt-2">Kembali</a>
            </form>
        </div>
    </div>
@endsection