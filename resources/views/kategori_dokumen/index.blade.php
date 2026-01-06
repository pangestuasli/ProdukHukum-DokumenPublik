@extends('layouts.admin.app')


@section('title', 'Kategori Dokumen')


@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="mb-0 fw-bold text-primary">Kategori Dokumen</h4>
                <small class="text-muted">Daftar kategori dokumen</small>
            </div>

            {{-- Search Form --}}
            <form method="GET" action="{{ route('kategori-dokumen.index') }}" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Cari kategori..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                @if(request('search'))
                    <a href="{{ route('kategori-dokumen.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> Clear
                    </a>
                @endif
            </form>
        </div>
    </div>

    {{-- Card List --}}
    <div class="row">
        @forelse($kategori as $k)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card kategori-card h-100">

                    {{-- Card Header --}}
                    <div class="kategori-card-header d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0 fw-semibold">{{ $k->nama }}</h6>
                                <small>Kategori ID: {{ $k->kategori_id }}</small>
                            </div>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body kategori-info">
                        <div class="info-item">
                            <i class="fas fa-file-alt"></i>
                            <span>{{ $k->deskripsi }}</span>
                        </div>
                    </div>

                    {{-- Card Footer --}}
                    

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-secondary text-center py-5">
                    <i class="fas fa-folder fa-2x mb-2"></i>
                    <p class="mb-0">Data kategori dokumen belum tersedia</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($kategori->hasPages())
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Pagination">
            <ul class="pagination pagination-lg">
                {{-- Previous Page Link --}}
                @if ($kategori->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $kategori->appends(request()->query())->previousPageUrl() }}" rel="prev">&laquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($kategori->getUrlRange(1, $kategori->lastPage()) as $page => $url)
                    @if ($page == $kategori->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $kategori->appends(request()->query())->url($page) }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($kategori->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $kategori->appends(request()->query())->nextPageUrl() }}" rel="next">&raquo;</a>
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