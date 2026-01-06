@extends('layouts.admin.app')


@section('title', 'Jenis Dokumen')


@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="mb-0 fw-bold text-primary">Jenis Dokumen</h4>
                <small class="text-muted">Daftar jenis dokumen</small>
            </div>

            {{-- Search Form --}}
            <form method="GET" action="{{ route('jenis_dokumen.index') }}" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Cari jenis dokumen..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                @if(request('search'))
                    <a href="{{ route('jenis_dokumen.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> Clear
                    </a>
                @endif
            </form>
        </div>
    </div>

    {{-- Card List --}}
    <div class="row">
        @forelse($jenis as $j)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card jenis-card h-100">

                    {{-- Card Header --}}
                    <div class="jenis-card-header d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0 fw-semibold">{{ $j->nama_jenis }}</h6>
                                <small>Jenis ID: {{ $j->jenis_id }}</small>
                            </div>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body jenis-info">
                        <div class="info-item">
                            <i class="fas fa-file-alt"></i>
                            <span>{{ $j->deskripsi }}</span>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-secondary text-center py-5">
                    <i class="fas fa-folder fa-2x mb-2"></i>
                    <p class="mb-0">Data jenis dokumen belum tersedia</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($jenis->hasPages())
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Pagination">
            <ul class="pagination pagination-lg">
                {{-- Previous Page Link --}}
                @if ($jenis->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $jenis->appends(request()->query())->previousPageUrl() }}" rel="prev">&laquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($jenis->getUrlRange(1, $jenis->lastPage()) as $page => $url)
                    @if ($page == $jenis->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $jenis->appends(request()->query())->url($page) }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($jenis->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $jenis->appends(request()->query())->nextPageUrl() }}" rel="next">&raquo;</a>
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