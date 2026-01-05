@extends('layouts.admin.app')


@section('title', 'Jenis Dokumen')


@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0 fw-bold text-primary">Jenis Dokumen</h4>
                <small class="text-muted">Daftar jenis dokumen</small>
            </div>
            <a href="{{ route('jenis_dokumen.create') }}" class="btn btn-primary">Tambah</a>
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

                    {{-- Card Footer --}}
                    <div class="card-footer jenis-footer">
                        <a href="{{ route('jenis_dokumen.edit', $j->jenis_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('jenis_dokumen.destroy', $j->jenis_id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</button>
                        </form>
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

</div>
@endsection