@extends('layouts.admin.app')

@section('title', 'Lampiran Dokumen')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0 fw-bold text-primary">Lampiran Dokumen</h4>
                <small class="text-muted">Daftar lampiran dokumen hukum</small>
            </div>
            <a href="{{ route('lampiran-dokumen.create') }}" class="btn btn-primary">Tambah</a>
        </div>
    </div>

    {{-- Card List --}}
    <div class="row">
        @forelse($lampiran as $l)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card lampiran-card h-100">

                    {{-- Card Header --}}
                    <div class="lampiran-card-header d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0 fw-semibold">{{ $l->keterangan }}</h6>
                                <small>Dokumen: {{ $l->dokumen->judul }}</small>
                            </div>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body lampiran-info">
                        <div class="info-item">
                            <i class="fas fa-file"></i>
                            <span>{{ basename($l->media) }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-calendar"></i>
                            <span>Dibuat: {{ $l->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>

                    {{-- Card Footer --}}
                    <div class="card-footer lampiran-footer">
                        <a href="{{ Storage::url($l->media) }}" target="_blank" class="btn btn-info btn-sm">Lihat</a>
                        <a href="{{ route('lampiran-dokumen.edit', $l->lampiran_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('lampiran-dokumen.destroy', $l->lampiran_id) }}" method="POST" style="display:inline">
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
                    <i class="fas fa-paperclip fa-2x mb-2"></i>
                    <p class="mb-0">Data lampiran dokumen belum tersedia</p>
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection