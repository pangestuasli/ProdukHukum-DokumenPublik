@extends('layouts.app')

@section('title', 'Dokumen Hukum')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Dokumen Hukum</h4>
                    
                    {{-- FLASH MESSAGE --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <a href="{{ route('dokumen-hukum.create') }}" class="btn btn-primary">
                                <i class="mdi mdi-plus-circle"></i> Tambah Dokumen
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nomor</th>
                                    <th>Judul</th>
                                    <th>Jenis</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dokumenHukum as $dokumen)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dokumen->nomor }}</td>
                                        <td>{{ Str::limit($dokumen->judul, 50) }}</td>
                                        <td>{{ $dokumen->jenisDokumen->nama_jenis ?? '-' }}</td>
                                        <td>{{ $dokumen->kategoriDokumen->nama ?? '-' }}</td>
                                        <td>{{ $dokumen->tanggal->format('d/m/Y') }}</td>
                                        <td>
                                            @if($dokumen->status == 'publik')
                                                <span class="badge badge-success">Publik</span>
                                            @elseif($dokumen->status == 'draft')
                                                <span class="badge badge-warning">Draft</span>
                                            @else
                                                <span class="badge badge-secondary">Arsip</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('dokumen-hukum.show', $dokumen->dokumen_id) }}" 
                                               class="btn btn-info btn-sm" title="Lihat">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="{{ route('dokumen-hukum.edit', $dokumen->dokumen_id) }}" 
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <form action="{{ route('dokumen-hukum.destroy', $dokumen->dokumen_id) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <div class="text-muted py-4">
                                                <i class="mdi mdi-file-document-outline mdi-48px"></i>
                                                <h5 class="mt-3">Belum ada data dokumen hukum</h5>
                                                <p>Mulai dengan menambahkan dokumen baru</p>
                                                <a href="{{ route('dokumen-hukum.create') }}" class="btn btn-primary">
                                                    <i class="mdi mdi-plus-circle"></i> Tambah Dokumen Pertama
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($dokumenHukum->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $dokumenHukum->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .badge-success {
        background-color: #28a745;
    }
    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }
    .badge-secondary {
        background-color: #6c757d;
    }
</style>
@endsection