@extends('layouts.admin.app')

@section('title','Data Warga')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="mb-0 fw-bold text-primary">Data Warga</h4>
                <small class="text-muted">Daftar penduduk terdaftar</small>
                @if(request('jenis_kelamin'))
                    <div class="mt-1">
                        <span class="badge bg-info">Filter: {{ request('jenis_kelamin') }}</span>
                    </div>
                @endif
            </div>

            {{-- Search Form --}}
            <form method="GET" action="{{ route('warga.index') }}" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Cari nama atau NIK..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                @if(request('search'))
                    <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> Clear
                    </a>
                @endif
            </form>

            {{-- Filter Form --}}
            <div class="d-flex align-items-center">
                <form method="GET" action="{{ route('warga.index') }}" class="d-flex gap-2">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <select name="jenis_kelamin" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">Semua Jenis Kelamin</option>
                        <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @if(request('jenis_kelamin'))
                        <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-times"></i> Reset
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>

    {{-- Card List --}}
    <div class="row">
        @forelse($wargas as $w)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card warga-card h-100">

                    {{-- Card Header --}}
                    <div class="warga-card-header d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0 fw-semibold">{{ $w->nama }}</h6>
                                <small>NIK: {{ $w->no_ktp }}</small>
                            </div>
                        </div>
                                
                        <span class="badge badge-gender 
                            {{ $w->jenis_kelamin == 'L' ? 'badge-pria' : 'badge-wanita' }}">
                            {{ $w->jenis_kelamin }}
                        </span>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body warga-info">
                        <div class="info-item">
                            <i class="fas fa-pray"></i>
                            <span>{{ $w->agama }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-briefcase"></i>
                            <span>{{ $w->pekerjaan }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-phone"></i>
                            <span>{{ $w->telp }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-envelope"></i>
                            <span class="text-truncate">{{ $w->email }}</span>
                        </div>
                    </div>

                    {{-- Card Footer --}}
                    <div class="card-footer warga-footer">
        

                       
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-secondary text-center py-5">
                    <i class="fas fa-users fa-2x mb-2"></i>
                    <p class="mb-0">Data warga belum tersedia</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($wargas->hasPages())
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Pagination">
            <ul class="pagination pagination-lg">
                {{-- Previous Page Link --}}
                @if ($wargas->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $wargas->appends(request()->query())->previousPageUrl() }}" rel="prev">&laquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($wargas->getUrlRange(1, $wargas->lastPage()) as $page => $url)
                    @if ($page == $wargas->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $wargas->appends(request()->query())->url($page) }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($wargas->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $wargas->appends(request()->query())->nextPageUrl() }}" rel="next">&raquo;</a>
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
