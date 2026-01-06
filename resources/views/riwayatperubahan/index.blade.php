@extends('layouts.app')

@section('title', 'Riwayat Perubahan')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Riwayat Perubahan Dokumen</h4>
                    
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

                    {{-- SIMPLE SEARCH --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <a href="{{ route('riwayat-perubahan.create') }}" class="btn btn-primary">
                                <i class="mdi mdi-plus-circle"></i> Tambah Riwayat
                            </a>
                        </div>
                        
                        <div class="col-md-6">
                            <form method="GET" action="{{ route('riwayat-perubahan.index') }}" class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Cari riwayat perubahan..."
                                           value="{{ request('search') }}">
                                    <button class="btn btn-outline-primary" type="submit">
                                        <i class="mdi mdi-magnify"></i>
                                    </button>
                                    @if(request('search'))
                                        <a href="{{ route('riwayat-perubahan.index') }}" 
                                           class="btn btn-outline-secondary">
                                            <i class="mdi mdi-close"></i>
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- DOKUMEN FILTER --}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <form method="GET" action="{{ route('riwayat-perubahan.index') }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="dokumen_id" class="form-select" onchange="this.form.submit()">
                                            <option value="">Semua Dokumen</option>
                                            @foreach($dokumenList as $dokumen)
                                                <option value="{{ $dokumen->dokumen_id }}" 
                                                    {{ request('dokumen_id') == $dokumen->dokumen_id ? 'selected' : '' }}>
                                                    {{ $dokumen->judul }} ({{ $dokumen->nomor }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="per_page" class="form-select" onchange="this.form.submit()">
                                            <option value="5" {{ request('per_page') == '5' ? 'selected' : '' }}>5 per halaman</option>
                                            <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10 per halaman</option>
                                            <option value="20" {{ request('per_page') == '20' ? 'selected' : '' }}>20 per halaman</option>
                                        </select>
                                    </div>
                                    @if(request()->hasAny(['search', 'dokumen_id', 'per_page']))
                                    <div class="col-md-3">
                                        <a href="{{ route('riwayat-perubahan.index') }}" class="btn btn-outline-secondary w-100">
                                            <i class="mdi mdi-refresh"></i> Reset Filter
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Dokumen</th>
                                    <th>Tanggal</th>
                                    <th>Uraian Perubahan</th>
                                    <th>Versi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($riwayatPerubahan as $riwayat)
                                    <tr>
                                        <td>{{ $loop->iteration + ($riwayatPerubahan->currentPage() - 1) * $riwayatPerubahan->perPage() }}</td>
                                        <td>
                                            <strong>{{ $riwayat->dokumenHukum->judul ?? '-' }}</strong><br>
                                            <small class="text-muted">{{ $riwayat->dokumenHukum->nomor ?? '' }}</small>
                                        </td>
                                        <td>{{ $riwayat->tanggal->format('d/m/Y') }}</td>
                                        <td>{{ Str::limit($riwayat->uraian_perubahan, 80) }}</td>
                                        <td>
                                            <span class="badge bg-info">v{{ $riwayat->versi }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('riwayat-perubahan.edit', $riwayat->riwayat_id) }}" 
                                                   class="btn btn-warning" title="Edit">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <form action="{{ route('riwayat-perubahan.destroy', $riwayat->riwayat_id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Hapus riwayat perubahan ini?')">
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
                                        <td colspan="6" class="text-center">
                                            <div class="text-muted py-4">
                                                <i class="mdi mdi-history mdi-48px"></i>
                                                <h5 class="mt-3">Belum ada riwayat perubahan</h5>
                                                @if(request()->hasAny(['search', 'dokumen_id']))
                                                    <p class="mb-3">Tidak ada hasil untuk filter yang dipilih</p>
                                                    <a href="{{ route('riwayat-perubahan.index') }}" class="btn btn-primary">
                                                        <i class="mdi mdi-refresh"></i> Reset Filter
                                                    </a>
                                                @else
                                                    <p>Mulai dengan menambahkan riwayat perubahan baru</p>
                                                    <a href="{{ route('riwayat-perubahan.create') }}" class="btn btn-primary">
                                                        <i class="mdi mdi-plus-circle"></i> Tambah Riwayat Pertama
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- SIMPLE PAGINATION --}}
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="text-muted mb-3 mb-sm-0">
                            Menampilkan {{ $riwayatPerubahan->firstItem() ?? 0 }} - {{ $riwayatPerubahan->lastItem() ?? 0 }} 
                            dari {{ $riwayatPerubahan->total() }} riwayat perubahan
                        </div>
                        
                        @if($riwayatPerubahan->hasPages())
                        <div>
                            {{ $riwayatPerubahan->links('pagination::bootstrap-5') }}
                        </div>
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
    .badge.bg-info {
        background-color: #17a2b8 !important;
    }
</style>

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
@endsection