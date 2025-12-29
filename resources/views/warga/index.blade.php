@extends('layouts.app')

@section('title', 'Data Warga')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">Data Warga</h4>
                    <a href="{{ route('warga.create') }}" class="btn btn-primary btn-icon-text">
                        <i class="ti-plus btn-icon-prepend"></i>
                        Tambah Warga
                    </a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No KTP</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Agama</th>
                                <th>Pekerjaan</th>
                                <th>Telp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($wargas as $warga)
                            <tr>
                                <td>{{ $loop->iteration + (($wargas->currentPage() - 1) * $wargas->perPage()) }}</td>
                                <td>{{ $warga->no_ktp }}</td>
                                <td>{{ $warga->nama }}</td>
                                <td>{{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $warga->agama }}</td>
                                <td>{{ $warga->pekerjaan }}</td>
                                <td>{{ $warga->telp }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('warga.show', $warga->warga_id) }}" class="btn btn-info btn-sm">
                                            <i class="ti-eye"></i>
                                        </a>
                                        <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-warning btn-sm">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <form action="{{ route('warga.destroy', $warga->warga_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                                <i class="ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data warga</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $wargas->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection