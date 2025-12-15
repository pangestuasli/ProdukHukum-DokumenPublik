@extends('layouts.app')

@section('title', 'Kategori Dokumen')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Kategori Dokumen</h4>
                    
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
                            <a href="{{ route('kategori-dokumen.create') }}" class="btn btn-primary">
                                <i class="mdi mdi-plus-circle"></i> Tambah Kategori
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kategoriDokumen as $kategori)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kategori->nama }}</td>
                                        <td>
                                            @if($kategori->deskripsi)
                                                {{ Str::limit($kategori->deskripsi, 50) }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $kategori->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('kategori-dokumen.show', $kategori->kategori_id) }}" 
                                               class="btn btn-info btn-sm" title="Lihat">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="{{ route('kategori-dokumen.edit', $kategori->kategori_id) }}" 
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <form action="{{ route('kategori-dokumen.destroy', $kategori->kategori_id) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
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
                                        <td colspan="5" class="text-center">
                                            <div class="text-muted py-4">
                                                <i class="mdi mdi-folder-open-outline mdi-48px"></i>
                                                <h5 class="mt-3">Belum ada data kategori dokumen</h5>
                                                <p>Mulai dengan menambahkan kategori baru</p>
                                                <a href="{{ route('kategori-dokumen.create') }}" class="btn btn-primary">
                                                    <i class="mdi mdi-plus-circle"></i> Tambah Kategori Pertama
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-sm {
        padding: 0.375rem 0.75rem;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.05);
    }
</style>
@endsection