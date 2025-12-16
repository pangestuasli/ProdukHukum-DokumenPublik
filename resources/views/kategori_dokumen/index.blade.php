@extends('layouts.admin.app')


@section('title', 'Kategori Dokumen')


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Kategori Dokumen</h4>
            <a href="{{ route('kategori-dokumen.create') }}" class="btn btn-primary">Tambah</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategori as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k->nama }}</td>
                            <td>{{ $k->deskripsi }}</td>
                            <td>
                                <a href="{{ route('kategori-dokumen.edit', $k->kategori_id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('kategori-dokumen.destroy', $k->kategori_id) }}" method="POST"
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