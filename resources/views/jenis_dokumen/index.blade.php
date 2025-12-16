@extends('layouts.admin.app')


@section('title', 'Jenis Dokumen')


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Jenis Dokumen</h4>
            <a href="{{ route('jenis_dokumen.create') }}" class="btn btn-primary">Tambah</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jenis</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jenis as $j)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $j->nama_jenis }}</td>
                            <td>{{ $j->deskripsi }}</td>
                            <td>
                                <a href="{{ route('jenis_dokumen.edit', $j->jenis_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('jenis_dokumen.destroy', $j->jenis_id) }}" method="POST"
                                    style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection