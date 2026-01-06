@extends('layouts.admin.app')
@section('title', 'Dokumen Hukum')


@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="mb-0 fw-bold text-primary">Dokumen Hukum</h4>
                <small class="text-muted">Daftar dokumen hukum</small>
            </div>

            {{-- Search Form --}}
            <form method="GET" action="{{ route('dokumen-hukum.index') }}" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Cari judul atau nomor..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                @if(request('search'))
                    <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> Clear
                    </a>
                @endif
            </form>
        </div>
    </div>

    {{-- Card List --}}
    <div class="row">
        @forelse($dokumen as $d)
            <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                <div class="card dokumen-card h-100">

                    {{-- Card Header --}}
                    <div class="dokumen-card-header d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0 fw-semibold">{{ $d->judul }}</h6>
                                <small>Nomor: {{ $d->nomor }}</small>
                            </div>
                        </div>

                        <span class="badge badge-status 
                            {{ $d->status == 'Aktif' ? 'badge-aktif' : 'badge-nonaktif' }}">
                            {{ $d->status }}
                        </span>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body dokumen-info">
                        <div class="info-item">
                            <i class="fas fa-tag"></i>
                            <span>Jenis: {{ $d->jenis->nama_jenis }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-folder"></i>
                            <span>Kategori: {{ $d->kategori->nama }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-calendar"></i>
                            <span>Tanggal: {{ $d->tanggal }}</span>
                        </div>
                        @if($d->ringkasan)
                        <div class="info-item">
                            <i class="fas fa-file-alt"></i>
                            <span>{{ $d->ringkasan }}</span>
                        </div>
                        @endif
                        @if($d->file_dokumen)
                        <div class="info-item">
                            <i class="fas fa-download"></i>
                            <a href="{{ asset('storage/' . $d->file_dokumen) }}" target="_blank">Download File</a>
                        </div>
                        @endif
                         </div>

                    {{-- Card Footer --}}
                    <div class="card-footer dokumen-footer text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('lampiran-dokumen.index') }}" class="btn btn-info btn-sm">
                                <i class="fas fa-paperclip"></i> Lampiran
                            </a>
                            <a href="{{ route('riwayat-perubahan.index') }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-history"></i> Riwayat
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-secondary text-center py-5">
                    <i class="fas fa-file-contract fa-2x mb-2"></i>
                    <p class="mb-0">Data dokumen hukum belum tersedia</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($dokumen->hasPages())
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Pagination">
            <ul class="pagination pagination-lg">
                {{-- Previous Page Link --}}
                @if ($dokumen->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $dokumen->appends(request()->query())->previousPageUrl() }}" rel="prev">&laquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($dokumen->getUrlRange(1, $dokumen->lastPage()) as $page => $url)
                    @if ($page == $dokumen->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $dokumen->appends(request()->query())->url($page) }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($dokumen->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $dokumen->appends(request()->query())->nextPageUrl() }}" rel="next">&raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">&raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
    @endif

</div>
@endsection