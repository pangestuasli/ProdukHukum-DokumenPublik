@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Warga</h2>

    <a href="{{ route('warga.create') }}" class="btn btn-primary mb-3">Tambah Warga</a>

    {{-- Flash Success --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Flash Error (optional, untuk validasi dari halaman lain) --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No KTP</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Pekerjaan</th>
                <th>Telp</th>
                <th>Email</th>
                <th style="width: 150px;">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($wargas as $w)
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

                    <form action="{{ route('warga.destroy', $w) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin hapus data ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>

            @empty
            <tr>
                <td colspan="8" class="text-center text-muted">Tidak ada data warga.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
