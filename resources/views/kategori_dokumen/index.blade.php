@extends('layouts.admin.app')


@section('title', 'Kategori Dokumen')


@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0 fw-bold text-primary">Kategori Dokumen</h4>
                <small class="text-muted">Daftar kategori dokumen</small>
            </div>
            <a href="{{ route('kategori-dokumen.create') }}" class="btn btn-primary">Tambah</a>
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
                    <div class="card-footer kategori-footer">
                        <a href="{{ route('kategori-dokumen.edit', $k->kategori_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kategori-dokumen.destroy', $k->kategori_id) }}" method="POST" style="display:inline">
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
                    <p class="mb-0">Data kategori dokumen belum tersedia</p>
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection