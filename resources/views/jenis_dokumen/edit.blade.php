@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Jenis Dokumen</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jenis_dokumen.update', $jenis_dokumen) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Jenis</label>
            <input type="text" name="nama_jenis" value="{{ old('nama_jenis', $jenis_dokumen->nama_jenis) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $jenis_dokumen->deskripsi) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Perbarui</button>
        <a href="{{ route('jenis_dokumen.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
