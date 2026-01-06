@extends('layouts.admin.app')

@section('title', 'Lampiran Dokumen')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="mb-0 fw-bold text-primary">Lampiran Dokumen</h4>
                <small class="text-muted">Daftar lampiran dokumen hukum</small>
            </div>

            {{-- Search Form --}}
            <form method="GET" action="{{ route('lampiran-dokumen.index') }}" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Cari lampiran atau dokumen..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                @if(request('search'))
                    <a href="{{ route('lampiran-dokumen.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> Clear
                    </a>
                @endif
            </form>
        </div>
    </div>

    {{-- Card List --}}
    <div class="row">
        @forelse($lampiran as $l)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card warga-card h-100">

                    {{-- Card Header --}}
                    <div class="warga-card-header d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0 fw-semibold">{{ $l->keterangan }}</h6>
                                <small>Dokumen: {{ $l->dokumen->judul ?? 'N/A' }}</small>
                            </div>
                        </div>

                        <span class="badge badge-gender badge-pria">
                            Lampiran
                        </span>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body warga-info">
                        <div class="info-item">
                            <i class="fas fa-file"></i>
                            <span>{{ basename($l->media) }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-calendar"></i>
                            <span>Dibuat: {{ $l->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-clock"></i>
                            <span>Diupdate: {{ $l->updated_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-folder"></i>
                            <span class="text-truncate">{{ $l->dokumen->judul ?? 'N/A' }}</span>
                        </div>
                    </div>

                    {{-- Card Footer --}}
                    <div class="card-footer warga-footer">
                        <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-info btn-sm w-100">
                            <i class="fas fa-arrow-left"></i> Kembali ke Dokumen Hukum
                        </a>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-secondary text-center py-5">
                    <i class="fas fa-paperclip fa-2x mb-2"></i>
                    <p class="mb-0">Data lampiran dokumen belum tersedia</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($lampiran->hasPages())
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Pagination">
            <ul class="pagination pagination-lg">
                {{-- Previous Page Link --}}
                @if ($lampiran->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $lampiran->appends(request()->query())->previousPageUrl() }}" rel="prev">&laquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($lampiran->getUrlRange(1, $lampiran->lastPage()) as $page => $url)
                    @if ($page == $lampiran->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $lampiran->appends(request()->query())->url($page) }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($lampiran->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $lampiran->appends(request()->query())->nextPageUrl() }}" rel="next">&raquo;</a>
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