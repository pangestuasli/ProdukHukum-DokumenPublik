@extends('layouts.app')

@section('title', 'Lampiran Dokumen Hukum')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Lampiran Dokumen Hukum</h4>
                    
                    {{-- FLASH MESSAGE --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-circle-outline me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-alert-circle-outline me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- SEARCH & FILTER --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <a href="{{ route('lampiran-dokumen.create') }}" class="btn btn-primary">
                                <i class="mdi mdi-plus-circle"></i> Tambah Lampiran
                            </a>
                        </div>
                        
                        <div class="col-md-12">
                            <form method="GET" action="{{ route('lampiran-dokumen.index') }}" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control" 
                                                   placeholder="Cari lampiran..."
                                                   value="{{ request('search') }}">
                                            <button class="btn btn-outline-primary" type="submit">
                                                <i class="mdi mdi-magnify"></i>
                                            </button>
                                            @if(request('search'))
                                                <a href="{{ route('lampiran-dokumen.index') }}" 
                                                   class="btn btn-outline-secondary">
                                                    <i class="mdi mdi-close"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <select name="dokumen_id" class="form-select" onchange="this.form.submit()">
                                            <option value="">Semua Dokumen</option>
                                            @foreach($dokumenList as $dokumen)
                                                <option value="{{ $dokumen->dokumen_id }}" 
                                                    {{ request('dokumen_id') == $dokumen->dokumen_id ? 'selected' : '' }}>
                                                    {{ Str::limit($dokumen->judul, 30) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <select name="per_page" class="form-select" onchange="this.form.submit()">
                                            <option value="5" {{ request('per_page') == '5' ? 'selected' : '' }}>5</option>
                                            <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                                            <option value="20" {{ request('per_page') == '20' ? 'selected' : '' }}>20</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- ACTIVE FILTERS --}}
                    @if(request()->hasAny(['search', 'dokumen_id', 'per_page']))
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
                                    <a href="{{ route('lampiran-dokumen.index', Arr::except(request()->query(), ['search'])) }}" 
                                       class="text-white ms-1">
                                        <i class="mdi mdi-close"></i>
                                    </a>
                                </span>
                                @endif
                                
                                @if(request('dokumen_id'))
                                @php
                                    $selectedDokumen = $dokumenList->firstWhere('dokumen_id', request('dokumen_id'));
                                @endphp
                                <span class="badge bg-info">
                                    <i class="mdi mdi-file-document me-1"></i>
                                    {{ $selectedDokumen->judul ?? 'Dokumen' }}
                                    <a href="{{ route('lampiran-dokumen.index', Arr::except(request()->query(), ['dokumen_id'])) }}" 
                                       class="text-white ms-1">
                                        <i class="mdi mdi-close"></i>
                                    </a>
                                </span>
                                @endif
                                
                                @if(request('per_page') && request('per_page') != '10')
                                <span class="badge bg-info">
                                    <i class="mdi mdi-format-list-bulleted me-1"></i>
                                    {{ request('per_page') }} per halaman
                                    <a href="{{ route('lampiran-dokumen.index', Arr::except(request()->query(), ['per_page'])) }}" 
                                       class="text-white ms-1">
                                        <i class="mdi mdi-close"></i>
                                    </a>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="80">No</th>
                                    <th>Dokumen Hukum</th>
                                    <th>File Lampiran</th>
                                    <th>Keterangan</th>
                                    <th width="150">Tanggal Upload</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lampiran as $item)
                                <tr>
                                    <td>{{ $loop->iteration + ($lampiran->currentPage() - 1) * $lampiran->perPage() }}</td>
                                    <td>
                                        @if($item->dokumenHukum)
                                            <div>
                                                <strong class="d-block">{{ Str::limit($item->dokumenHukum->judul, 40) }}</strong>
                                                <small class="text-muted">{{ $item->dokumenHukum->nomor ?? '-' }}</small>
                                            </div>
                                        @else
                                            <span class="text-danger">Dokumen tidak ditemukan</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @php
                                                $extension = pathinfo($item->berkas_lampiran, PATHINFO_EXTENSION);
                                                $icon = match(strtolower($extension)) {
                                                    'pdf' => 'mdi-file-pdf',
                                                    'jpg', 'jpeg', 'png', 'gif' => 'mdi-image',
                                                    'doc', 'docx' => 'mdi-file-word',
                                                    'xls', 'xlsx' => 'mdi-file-excel',
                                                    default => 'mdi-file'
                                                };
                                                $color = match(strtolower($extension)) {
                                                    'pdf' => 'text-danger',
                                                    'jpg', 'jpeg', 'png', 'gif' => 'text-success',
                                                    'doc', 'docx' => 'text-primary',
                                                    'xls', 'xlsx' => 'text-success',
                                                    default => 'text-secondary'
                                                };
                                            @endphp
                                            <i class="mdi {{ $icon }} {{ $color }} me-2"></i>
                                            <div>
                                                <div class="text-truncate" style="max-width: 150px;">
                                                    {{ $item->berkas_lampiran }}
                                                </div>
                                                <small class="text-muted">{{ strtoupper($extension) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->keterangan)
                                            <div class="text-truncate" style="max-width: 200px;">
                                                {{ $item->keterangan }}
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-muted small">
                                            {{ $item->created_at->format('d/m/Y') }}
                                            <div class="text-muted">
                                                {{ $item->created_at->format('H:i') }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('lampiran-dokumen.show', $item->lampiran_id) }}" 
                                               class="btn btn-info" title="Lihat">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a href="{{ route('lampiran-dokumen.edit', $item->lampiran_id) }}" 
                                               class="btn btn-warning" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-danger" 
                                                    title="Hapus"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $item->lampiran_id }}">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <div class="text-muted py-4">
                                            <i class="mdi mdi-paperclip mdi-48px"></i>
                                            <h5 class="mt-3">Belum ada lampiran dokumen</h5>
                                            @if(request()->hasAny(['search', 'dokumen_id']))
                                                <p class="mb-3">Tidak ada hasil untuk filter yang dipilih</p>
                                                <a href="{{ route('lampiran-dokumen.index') }}" class="btn btn-primary">
                                                    <i class="mdi mdi-refresh"></i> Reset Filter
                                                </a>
                                            @else
                                                <p>Mulai dengan menambahkan lampiran baru</p>
                                                <a href="{{ route('lampiran-dokumen.create') }}" class="btn btn-primary">
                                                    <i class="mdi mdi-plus-circle"></i> Tambah Lampiran Pertama
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
                            Menampilkan {{ $lampiran->firstItem() ?? 0 }} - {{ $lampiran->lastItem() ?? 0 }} 
                            dari {{ $lampiran->total() }} lampiran
                        </div>
                        
                        @if($lampiran->hasPages())
                        <div>
                            {{ $lampiran->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modals -->
@foreach($lampiran as $item)
<div class="modal fade" id="deleteModal{{ $item->lampiran_id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->lampiran_id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $item->lampiran_id }}">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="mdi mdi-alert-circle-outline"></i>
                    <strong>Perhatian!</strong>
                    <p class="mb-0 mt-2">
                        Apakah Anda yakin ingin menghapus lampiran ini?
                    </p>
                    <p class="mb-0 mt-2">
                        <strong>File:</strong> {{ $item->berkas_lampiran }}
                    </p>
                    @if($item->dokumenHukum)
                    <p class="mb-0 mt-2">
                        <strong>Dokumen:</strong> {{ $item->dokumenHukum->judul }}
                    </p>
                    @endif
                    <p class="mb-0 mt-2">
                        File akan dihapus permanen dari sistem.
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('lampiran-dokumen.destroy', $item->lampiran_id) }}" method="POST">
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
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
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
                this.form.submit();
            }
        });
    });
</script>
@endpush
@endsection