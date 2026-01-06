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
                            <i class="mdi mdi-check-circle-outline me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-alert-circle-outline me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- FILTER & SEARCH SECTION --}}
                    <div class="row mb-3">
                        <div class="col-md-6 mb-2">
                            <a href="{{ route('kategori-dokumen.create') }}" class="btn btn-primary">
                                <i class="mdi mdi-plus-circle"></i> Tambah Kategori
                            </a>
                        </div>
                        
                        <div class="col-md-6">
                            <form method="GET" action="{{ route('kategori-dokumen.index') }}" class="row g-2">
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" 
                                               placeholder="Cari kategori..."
                                               value="{{ request('search') }}">
                                        <button class="btn btn-outline-primary" type="submit">
                                            <i class="mdi mdi-magnify"></i>
                                        </button>
                                        @if(request('search'))
                                            <a href="{{ route('kategori-dokumen.index') }}" 
                                               class="btn btn-outline-secondary">
                                                <i class="mdi mdi-close"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <select name="per_page" class="form-select" onchange="this.form.submit()">
                                        <option value="5" {{ request('per_page') == '5' ? 'selected' : '' }}>5 per halaman</option>
                                        <option value="10" {{ request('per_page') == '10' || !request('per_page') ? 'selected' : '' }}>10 per halaman</option>
                                        <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25 per halaman</option>
                                        <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50 per halaman</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- ACTIVE FILTERS --}}
                    @if(request()->hasAny(['search', 'per_page']))
                    <div class="alert alert-light mb-3 py-2">
                        <div class="d-flex align-items-center">
                            <span class="me-2">
                                <i class="mdi mdi-filter text-primary"></i>
                                <strong>Filter aktif:</strong>
                            </span>
                            <div class="d-flex flex-wrap gap-2">
                                @if(request('search'))
                                <span class="badge bg-info">
                                    <i class="mdi mdi-magnify me-1"></i>
                                    "{{ request('search') }}"
                                </span>
                                @endif
                                
                                @if(request('per_page') && request('per_page') != '10')
                                <span class="badge bg-info">
                                    <i class="mdi mdi-format-list-bulleted me-1"></i>
                                    {{ request('per_page') }} per halaman
                                </span>
                                @endif

                                <a href="{{ route('kategori-dokumen.index') }}" class="badge bg-danger text-decoration-none">
                                    <i class="mdi mdi-close-circle me-1"></i>
                                    Reset Semua
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="80">No</th>
                                    <th>Nama Kategori</th>
                                    <th>Deskripsi</th>
                                    <th width="150">Jumlah Dokumen</th>
                                    <th width="180">Tanggal Dibuat</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kategoriDokumen as $kategori)
                                    <tr>
                                        <td>{{ $loop->iteration + ($kategoriDokumen->currentPage() - 1) * $kategoriDokumen->perPage() }}</td>
                                        <td>
                                            <strong>{{ $kategori->nama }}</strong><br>
                                            <small class="text-muted">ID: {{ $kategori->kategori_id }}</small>
                                        </td>
                                        <td>
                                            @if($kategori->deskripsi)
                                                <span class="text-truncate d-inline-block" style="max-width: 250px;">
                                                    {{ $kategori->deskripsi }}
                                                </span>
                                            @else
                                                <span class="text-muted fst-italic">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $kategori->dokumen_hukum_count ?? 0 }} dokumen
                                            </span>
                                        </td>
                                        <td>
                                            <div class="small">
                                                <i class="mdi mdi-calendar text-muted me-1"></i>
                                                {{ $kategori->created_at->format('d M Y') }}
                                            </div>
                                            <div class="text-muted small">
                                                <i class="mdi mdi-clock text-muted me-1"></i>
                                                {{ $kategori->created_at->format('H:i') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('kategori-dokumen.show', $kategori->kategori_id) }}" 
                                                   class="btn btn-info" title="Lihat">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>
                                                <a href="{{ route('kategori-dokumen.edit', $kategori->kategori_id) }}" 
                                                   class="btn btn-warning" title="Edit">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-danger" 
                                                        title="Hapus"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#deleteModal{{ $kategori->kategori_id }}">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <div class="text-muted py-4">
                                                <i class="mdi mdi-folder-open-outline mdi-48px"></i>
                                                <h5 class="mt-3">Belum ada data kategori dokumen</h5>
                                                @if(request('search'))
                                                    <p class="mb-3">Tidak ada hasil untuk pencarian "{{ request('search') }}"</p>
                                                    <a href="{{ route('kategori-dokumen.index') }}" class="btn btn-primary">
                                                        <i class="mdi mdi-refresh"></i> Reset Filter
                                                    </a>
                                                @else
                                                    <p>Mulai dengan menambahkan kategori baru</p>
                                                    <a href="{{ route('kategori-dokumen.create') }}" class="btn btn-primary">
                                                        <i class="mdi mdi-plus-circle"></i> Tambah Kategori Pertama
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- PAGINATION --}}
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="text-muted mb-3 mb-sm-0">
                            Menampilkan {{ $kategoriDokumen->firstItem() ?? 0 }} - {{ $kategoriDokumen->lastItem() ?? 0 }} 
                            dari {{ $kategoriDokumen->total() }} kategori dokumen
                        </div>
                        
                        @if($kategoriDokumen->hasPages())
                            <div>
                                {{ $kategoriDokumen->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modals -->
@foreach($kategoriDokumen as $kategori)
<div class="modal fade" id="deleteModal{{ $kategori->kategori_id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $kategori->kategori_id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $kategori->kategori_id }}">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="mdi mdi-alert-circle-outline"></i>
                    <strong>Perhatian!</strong>
                    <p class="mb-0 mt-2">
                        Apakah Anda yakin ingin menghapus kategori "<strong>{{ $kategori->nama }}</strong>"?
                    </p>
                    @if(($kategori->dokumen_hukum_count ?? 0) > 0)
                    <p class="mb-0 mt-2">
                        <i class="mdi mdi-information-outline"></i>
                        Kategori ini memiliki {{ $kategori->dokumen_hukum_count }} dokumen terkait. 
                        Penghapusan mungkin akan mempengaruhi data dokumen yang ada.
                    </p>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('kategori-dokumen.destroy', $kategori->kategori_id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
    .btn-group .btn {
        padding: 0.375rem 0.75rem;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
    .text-truncate {
        display: inline-block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .alert-light {
        background-color: #f8f9fa;
        border-color: #e9ecef;
    }
    .badge.bg-primary {
        padding: 0.35em 0.65em;
        font-weight: 500;
        font-size: 0.875em;
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Focus pada search input jika ada search parameter
        @if(request('search'))
        document.querySelector('input[name="search"]')?.focus();
        @endif
    });
</script>
@endpush
@endsection