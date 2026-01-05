@extends('layouts.admin.app')
@section('title', 'Dokumen Hukum')


@section('content')
<div class="container-fluid">

    

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
    <a href="{{ route('riwayat-perubahan.index') }}"
       class="btn btn-info btn-sm">
        Lihat Riwayat
    </a>
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

</div>
@endsection