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

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <a href="{{ route('riwayat-perubahan.create') }}" class="btn btn-primary">
                                <i class="mdi mdi-plus-circle"></i> Tambah Riwayat
                            </a>
                        </div>
                        <div class="col-md-4">
                            <form method="GET" action="{{ route('riwayat-perubahan.index') }}">
                                <div class="input-group">
                                    <select name="dokumen_id" class="form-control" onchange="this.form.submit()">
                                        <option value="">Semua Dokumen</option>
                                        @foreach($dokumenList as $dokumen)
                                            <option value="{{ $dokumen->dokumen_id }}" 
                                                {{ request('dokumen_id') == $dokumen->dokumen_id ? 'selected' : '' }}>
                                                {{ $dokumen->judul }} ({{ $dokumen->nomor }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='{{ route('riwayat-perubahan.index') }}'">
                                        <i class="mdi mdi-refresh"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
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
                                            <a href="{{ route('riwayat-perubahan.edit', $riwayat->riwayat_id) }}" 
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <form action="{{ route('riwayat-perubahan.destroy', $riwayat->riwayat_id) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Hapus riwayat perubahan ini?')">
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
                                        <td colspan="6" class="text-center">
                                            <div class="text-muted py-4">
                                                <i class="mdi mdi-history mdi-48px"></i>
                                                <h5 class="mt-3">Belum ada riwayat perubahan</h5>
                                                <a href="{{ route('riwayat-perubahan.create') }}" class="btn btn-primary mt-2">
                                                    <i class="mdi mdi-plus-circle"></i> Tambah Riwayat Pertama
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($riwayatPerubahan->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $riwayatPerubahan->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .badge.bg-info {
        background-color: #17a2b8 !important;
    }
    .btn-sm {
        padding: 0.375rem 0.75rem;
    }
</style>
@endsection