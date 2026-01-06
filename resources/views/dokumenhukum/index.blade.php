@extends('layouts.app')

@section('title', 'Dokumen Hukum')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Dokumen Hukum</h4>

                    {{-- Flash Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-circle-outline me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- SEARCH & PAGINATION --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <a href="{{ route('dokumen-hukum.create') }}" class="btn btn-primary">
                                <i class="mdi mdi-plus"></i> Tambah Dokumen
                            </a>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="d-flex gap-2">
                                <form method="GET" action="{{ route('dokumen-hukum.index') }}" class="flex-grow-1">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" 
                                               placeholder="Cari dokumen..."
                                               value="{{ request('search') }}">
                                        <button class="btn btn-outline-primary" type="submit">
                                            <i class="mdi mdi-magnify"></i>
                                        </button>
                                        @if(request('search'))
                                            <a href="{{ route('dokumen-hukum.index') }}" 
                                               class="btn btn-outline-secondary">
                                                <i class="mdi mdi-close"></i>
                                            </a>
                                        @endif
                                    </div>
                                </form>
                                
                                <select name="per_page" class="form-select" style="width: auto;" 
                                        onchange="window.location.href = '{{ route('dokumen-hukum.index') }}?per_page=' + this.value + '&search={{ request('search') }}&status={{ request('status') }}'">
                                    <option value="5" {{ request('per_page') == '5' ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('per_page') == '20' ? 'selected' : '' }}>20</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- STATUS FILTER --}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="btn-group" role="group">
                                <a href="{{ route('dokumen-hukum.index') }}?status=&search={{ request('search') }}&per_page={{ request('per_page', 10) }}" 
                                   class="btn btn-outline-primary {{ !request('status') ? 'active' : '' }}">
                                    Semua
                                </a>
                                <a href="{{ route('dokumen-hukum.index') }}?status=publik&search={{ request('search') }}&per_page={{ request('per_page', 10) }}" 
                                   class="btn btn-outline-primary {{ request('status') == 'publik' ? 'active' : '' }}">
                                    Publik
                                </a>
                                <a href="{{ route('dokumen-hukum.index') }}?status=draft&search={{ request('search') }}&per_page={{ request('per_page', 10) }}" 
                                   class="btn btn-outline-primary {{ request('status') == 'draft' ? 'active' : '' }}">
                                    Draft
                                </a>
                                <a href="{{ route('dokumen-hukum.index') }}?status=arsip&search={{ request('search') }}&per_page={{ request('per_page', 10) }}" 
                                   class="btn btn-outline-primary {{ request('status') == 'arsip' ? 'active' : '' }}">
                                    Arsip
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- ACTIVE FILTERS --}}
                    @if(request()->hasAny(['search', 'status', 'per_page']))
                    <div class="alert alert-light mb-3 py-2">
                        <div class="d-flex align-items-center">
                            <span class="me-2">
                                <i class="mdi mdi-filter text-primary"></i>
                                Filter aktif:
                            </span>
                            <div class="d-flex flex-wrap gap-2">
                                @if(request('search'))
                                <span class="badge bg-info">
                                    <i class="mdi mdi-magnify me-1"></i>
                                    "{{ request('search') }}"
                                    <a href="{{ route('dokumen-hukum.index', Arr::except(request()->query(), ['search'])) }}" 
                                       class="text-white ms-1">
                                        <i class="mdi mdi-close"></i>
                                    </a>
                                </span>
                                @endif
                                
                                @if(request('status'))
                                <span class="badge bg-info">
                                    <i class="mdi mdi-circle me-1"></i>
                                    {{ ucfirst(request('status')) }}
                                    <a href="{{ route('dokumen-hukum.index', Arr::except(request()->query(), ['status'])) }}" 
                                       class="text-white ms-1">
                                        <i class="mdi mdi-close"></i>
                                    </a>
                                </span>
                                @endif
                                
                                @if(request('per_page') && request('per_page') != '10')
                                <span class="badge bg-info">
                                    <i class="mdi mdi-format-list-bulleted me-1"></i>
                                    {{ request('per_page') }} per halaman
                                    <a href="{{ route('dokumen-hukum.index', Arr::except(request()->query(), ['per_page'])) }}" 
                                       class="text-white ms-1">
                                        <i class="mdi mdi-close"></i>
                                    </a>
                                </span>
                                @endif
                                
                                <a href="{{ route('dokumen-hukum.index') }}" class="badge bg-danger text-decoration-none">
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
                                    <th width="80">#</th>
                                    <th>Nomor</th>
                                    <th>Judul</th>
                                    <th>Jenis</th>
                                    <th>Kategori</th>
                                    <th width="120">Tanggal</th>
                                    <th width="120">File</th>
                                    <th width="100">Status</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dokumenHukum as $dokumen)
                                    <tr>
                                        <td>{{ $loop->iteration + ($dokumenHukum->currentPage() - 1) * $dokumenHukum->perPage() }}</td>
                                        <td><strong>{{ $dokumen->nomor }}</strong></td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 200px;">
                                                {{ $dokumen->judul }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">
                                                {{ $dokumen->jenisDokumen->nama_jenis ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-secondary">
                                                {{ $dokumen->kategoriDokumen->nama ?? '-' }}
                                            </span>
                                        </td>
                                        <td>{{ $dokumen->tanggal->format('d/m/Y') }}</td>
                                        <td>
                                            @if($dokumen->fileUtama)
                                                <div class="d-flex align-items-center">
                                                    @php
                                                        $file = $dokumen->fileUtama;
                                                        $ext = pathinfo($file->file_url, PATHINFO_EXTENSION);
                                                        $ext = strtolower($ext);
                                                        
                                                        if ($ext == 'pdf') {
                                                            $icon = 'mdi-file-pdf text-danger';
                                                            $badge = 'PDF';
                                                        } elseif (in_array($ext, ['doc', 'docx'])) {
                                                            $icon = 'mdi-file-word text-primary';
                                                            $badge = 'DOC';
                                                        } elseif (in_array($ext, ['xls', 'xlsx'])) {
                                                            $icon = 'mdi-file-excel text-success';
                                                            $badge = 'EXCEL';
                                                        } elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                                                            $icon = 'mdi-file-image text-warning';
                                                            $badge = 'IMG';
                                                        } else {
                                                            $icon = 'mdi-file text-secondary';
                                                            $badge = 'FILE';
                                                        }
                                                    @endphp
                                                    <i class="mdi {{ $icon }} me-1"></i>
                                                    <small>{{ $badge }}</small>
                                                </div>
                                            @else
                                                <div class="text-center">
                                                    <i class="mdi mdi-file-remove text-muted"></i>
                                                    <div>
                                                        <small class="text-muted">-</small>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
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
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('dokumen-hukum.show', $dokumen->dokumen_id) }}"
                                                    class="btn btn-info" title="Lihat">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>
                                                <a href="{{ route('dokumen-hukum.edit', $dokumen->dokumen_id) }}"
                                                    class="btn btn-warning" title="Edit">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-danger" 
                                                        title="Hapus"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#deleteModal{{ $dokumen->dokumen_id }}">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="mdi mdi-file-document-outline mdi-48px"></i>
                                                <h5 class="mt-3">Belum ada dokumen</h5>
                                                @if(request()->hasAny(['search', 'status']))
                                                    <p class="mb-3">Tidak ada hasil untuk filter yang dipilih</p>
                                                    <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-primary">
                                                        <i class="mdi mdi-refresh"></i> Reset Filter
                                                    </a>
                                                @else
                                                    <p>Mulai dengan menambahkan dokumen baru</p>
                                                    <a href="{{ route('dokumen-hukum.create') }}" class="btn btn-primary">
                                                        <i class="mdi mdi-plus"></i> Tambah Dokumen Pertama
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
                            Menampilkan {{ $dokumenHukum->firstItem() ?? 0 }} - {{ $dokumenHukum->lastItem() ?? 0 }} 
                            dari {{ $dokumenHukum->total() }} dokumen
                        </div>
                        
                        @if($dokumenHukum->hasPages())
                            <div>
                                {{ $dokumenHukum->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modals -->
@foreach($dokumenHukum as $dokumen)
<div class="modal fade" id="deleteModal{{ $dokumen->dokumen_id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $dokumen->dokumen_id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $dokumen->dokumen_id }}">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="mdi mdi-alert-circle-outline"></i>
                    <strong>Perhatian!</strong>
                    <p class="mb-0 mt-2">
                        Apakah Anda yakin ingin menghapus dokumen ini?
                    </p>
                    <p class="mb-0 mt-2">
                        <strong>Judul:</strong> {{ $dokumen->judul }}
                    </p>
                    <p class="mb-0 mt-2">
                        <strong>Nomor:</strong> {{ $dokumen->nomor }}
                    </p>
                    <p class="mb-0 mt-2">
                        Semua file dan lampiran terkait juga akan dihapus permanen.
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('dokumen-hukum.destroy', $dokumen->dokumen_id) }}" method="POST">
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
    .badge-success {
        background: #28a745;
    }
    .badge-warning {
        background: #ffc107;
        color: #000;
    }
    .badge-secondary {
        background: #6c757d;
    }
    .badge-info {
        background: #17a2b8;
    }
    .mdi {
        vertical-align: middle;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .btn-group .btn {
        padding: 0.375rem 0.75rem;
    }
    .badge-info a {
        text-decoration: none;
    }
    .badge-info a:hover {
        opacity: 0.8;
    }
    .alert-light {
        background-color: #f8f9fa;
        border-color: #e9ecef;
    }
    .btn-group .btn-outline-primary.active {
        background-color: #007bff;
        color: white;
    }
    .btn-outline-primary {
        color: #007bff;
        border-color: #007bff;
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Focus pada search input jika ada search parameter
        @if(request('search'))
        document.querySelector('input[name="search"]').focus();
        @endif
        
        // Handle enter key in search input
        document.querySelector('input[name="search"]')?.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.closest('form').submit();
            }
        });
    });
</script>
@endpush
@endsection