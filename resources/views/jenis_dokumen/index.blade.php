@extends('layouts.app')

@section('title', 'Jenis Dokumen')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Jenis Dokumen</h4>
                    
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

                    {{-- FILTER & SEARCH FORM --}}
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <a href="{{ route('jenis_dokumen.create') }}" class="btn btn-primary">
                                <i class="mdi mdi-plus-circle"></i> Tambah Jenis
                            </a>
                        </div>
                        
                        <div class="col-md-4">
                            <form method="GET" action="{{ route('jenis_dokumen.index') }}">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Cari jenis dokumen..."
                                           value="{{ request('search') }}">
                                    <button class="btn btn-outline-primary" type="submit">
                                        <i class="mdi mdi-magnify"></i>
                                    </button>
                                    @if(request('search'))
                                        <a href="{{ route('jenis_dokumen.index') }}" 
                                           class="btn btn-outline-secondary">
                                            <i class="mdi mdi-close"></i>
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="80">No</th>
                                    <th>
                                        Nama Jenis
                                        @if(request('sort') == 'nama_jenis')
                                            <i class="mdi mdi-arrow-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </th>
                                    <th>Deskripsi</th>
                                    <th width="180">
                                        Tanggal Dibuat
                                        @if(request('sort') == 'created_at')
                                            <i class="mdi mdi-arrow-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $row)
                                    <tr>
                                        <td>{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
                                        <td>
                                            <strong>{{ $row->nama_jenis }}</strong><br>
                                            <small class="text-muted">ID: {{ $row->jenis_id }}</small>
                                        </td>
                                        <td>
                                            @if($row->deskripsi)
                                                <span class="text-truncate d-inline-block" style="max-width: 300px;">
                                                    {{ $row->deskripsi }}
                                                </span>
                                            @else
                                                <span class="text-muted fst-italic">Tidak ada deskripsi</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="small">
                                                <i class="mdi mdi-calendar text-muted me-1"></i>
                                                {{ $row->created_at->format('d M Y') }}
                                            </div>
                                            <div class="text-muted small">
                                                <i class="mdi mdi-clock text-muted me-1"></i>
                                                {{ $row->created_at->format('H:i') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('jenis_dokumen.edit', $row->jenis_id) }}" 
                                                   class="btn btn-warning" title="Edit">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <form action="{{ route('jenis_dokumen.destroy', $row->jenis_id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus jenis dokumen ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" title="Hapus">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <div class="text-muted py-4">
                                                <i class="mdi mdi-file-document-outline mdi-48px"></i>
                                                <h5 class="mt-3">Belum ada data jenis dokumen</h5>
                                                @if(request('search') || request('sort') || request('order'))
                                                    <p class="mb-3">Tidak ada hasil untuk filter yang dipilih</p>
                                                    <a href="{{ route('jenis_dokumen.index') }}" class="btn btn-primary">
                                                        <i class="mdi mdi-refresh"></i> Reset Filter
                                                    </a>
                                                @else
                                                    <p>Mulai dengan menambahkan jenis dokumen baru</p>
                                                    <a href="{{ route('jenis_dokumen.create') }}" class="btn btn-primary">
                                                        <i class="mdi mdi-plus-circle"></i> Tambah Jenis Pertama
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="text-muted mb-3 mb-sm-0">
                            Menampilkan {{ $data->firstItem() ?? 0 }} - {{ $data->lastItem() ?? 0 }} 
                            dari {{ $data->total() }} jenis dokumen
                        </div>
                        
                        @if($data->hasPages())
                            <nav aria-label="Page navigation">
                                <ul class="pagination mb-0">
                                    {{-- Previous Page Link --}}
                                    @if($data->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">
                                                <i class="mdi mdi-chevron-left"></i> Previous
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $data->appends(request()->query())->previousPageUrl() }}" rel="prev">
                                                <i class="mdi mdi-chevron-left"></i> Previous
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                                        @if($page == $data->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $data->appends(request()->query())->url($page) }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if($data->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $data->appends(request()->query())->nextPageUrl() }}" rel="next">
                                                Next <i class="mdi mdi-chevron-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link">
                                                Next <i class="mdi mdi-chevron-right"></i>
                                            </span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-group .btn {
        padding: 0.375rem 0.75rem;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
    .text-truncate {
        display: inline-block;
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }
    .page-link {
        color: #007bff;
    }
    .pagination {
        margin-bottom: 0;
    }
    .form-label {
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    .input-group {
        width: 100%;
    }
</style>

<script>
    // Fungsi untuk submit form filter ketika dropdown berubah
    document.addEventListener('DOMContentLoaded', function() {
        const perPageSelect = document.getElementById('per_page');
        if (perPageSelect) {
            perPageSelect.addEventListener('change', function() {
                this.form.submit();
            });
        }
        
        // Tambahkan juga untuk sort dan order jika ingin auto-submit
        const sortSelect = document.getElementById('sort');
        const orderSelect = document.getElementById('order');
        
        if (sortSelect) {
            sortSelect.addEventListener('change', function() {
                this.form.submit();
            });
        }
        
        if (orderSelect) {
            orderSelect.addEventListener('change', function() {
                this.form.submit();
            });
        }
    });
</script>
@endsection