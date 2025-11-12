@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Jenis Dokumen</h2>
    <a href="{{ route('jenis_dokumen.create') }}" class="btn btn-primary mb-3">Tambah Jenis Dokumen</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Jenis</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
                <tr>
                    <td>{{ $row->jenis_id }}</td>
                    <td>{{ $row->nama_jenis }}</td>
                    <td>{{ $row->deskripsi }}</td>
                    <td>
                        <a href="{{ route('jenis_dokumen.edit', $row->jenis_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('jenis_dokumen.destroy', $row->jenis_id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
