@extends('layouts.admin.app')
@section('title', 'Dokumen Hukum')


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Dokumen Hukum</h4>
            <a href="{{ route('dokumen-hukum.create') }}" class="btn btn-primary">Tambah</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Nomor</th>
                    <th>Judul</th>
                    <th>Jenis</th>
                    <th>Kategori</th>
                    <th>File</th>
                    <th>Aksi</th>
                </tr>
                @foreach($dokumen as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->nomor }}</td>
                        <td>{{ $d->judul }}</td>
                        <td>{{ $d->jenis->nama_jenis }}</td>
                        <td>{{ $d->kategori->nama }}</td>
                        <td>
                            @if($d->file_dokumen)
                                <a href="{{ asset('storage/' . $d->file_dokumen) }}" target="_blank">Download</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('dokumen-hukum.edit', $d->dokumen_id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('dokumen-hukum.destroy', $d->dokumen_id) }}" method="POST"
                                style="display:inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection