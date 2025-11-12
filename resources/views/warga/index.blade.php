@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Warga</h2>
    <a href="{{ route('warga.create') }}" class="btn btn-primary mb-3">Tambah Warga</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No KTP</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Pekerjaan</th>
                <th>Telp</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($wargas as $w)
            <tr>
                <td>{{ $w->no_ktp }}</td>
                <td>{{ $w->nama }}</td>
                <td>{{ $w->jenis_kelamin }}</td>
                <td>{{ $w->agama }}</td>
                <td>{{ $w->pekerjaan }}</td>
                <td>{{ $w->telp }}</td>
                <td>{{ $w->email }}</td>
                <td>
                    <a href="{{ route('warga.edit', $w) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('warga.destroy', $w) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
