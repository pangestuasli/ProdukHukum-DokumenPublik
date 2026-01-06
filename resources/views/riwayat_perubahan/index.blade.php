@extends('layouts.admin.app')

@section('title', 'Riwayat Perubahan Dokumen')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="mb-0 fw-bold text-primary">Riwayat Perubahan Dokumen</h4>
                <small class="text-muted">Daftar riwayat perubahan dokumen hukum</small>
            </div>

            {{-- Search Form --}}
            <form method="GET" action="{{ route('riwayat-perubahan.index') }}" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Cari dokumen atau perubahan..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                @if(request('search'))
                    <a href="{{ route('riwayat-perubahan.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> Clear
                    </a>
                @endif
            </form>
        </div>
    </div>

    {{-- Card List --}}
    <div class="row">
        @forelse($riwayat as $r)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card riwayat-card h-100">

                    {{-- Card Header --}}
                    <div class="riwayat-card-header d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0 fw-semibold">{{ $r->dokumenHukum->judul ?? 'Dokumen Tidak Ditemukan' }}</h6>
                                <small>Nomor: {{ $r->dokumenHukum->nomor ?? '-' }}</small>
                            </div>
                        </div>

                        <span class="badge badge-gender badge-pria">
                            Versi {{ $r->versi }}
                        </span>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body riwayat-info">
                        <div class="info-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ $r->tanggal?->format('d-m-Y') }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-file-alt"></i>
                            <span>Uraian Perubahan</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-comment"></i>
                            <span class="text-truncate">{{ $r->uraian_perubahan }}</span>
                        </div>
                    </div>

                    {{-- Card Footer --}}
                    <div class="card-footer riwayat-footer">



                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-secondary text-center py-5">
                    <i class="fas fa-history fa-2x mb-2"></i>
                    <p class="mb-0">Belum ada riwayat perubahan</p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('dokumen-hukum.index') }}"
               class="btn btn-secondary">
               Kembali ke Dokumen
            </a>
        </div>
    </div>

</div>
@endsection
