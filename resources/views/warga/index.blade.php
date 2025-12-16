@extends('layouts.admin.app')

@section('title','Data Warga')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0 fw-bold text-primary">Data Warga</h4>
                <small class="text-muted">Daftar penduduk terdaftar</small>
            </div>

            <a href="{{ route('warga.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-user-plus me-1"></i> Tambah Warga
            </a>
        </div>
    </div>

    {{-- Card List --}}
    <div class="row">
        @forelse($warga as $w)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card warga-card h-100">

                    {{-- Card Header --}}
                    <div class="warga-card-header d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="avatar me-3">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-semibold">{{ $w->nama }}</h6>
                                <small>NIK: {{ $w->no_ktp }}</small>
                            </div>
                        </div>

                        <span class="badge badge-gender 
                            {{ $w->jenis_kelamin == 'Laki-laki' ? 'badge-pria' : 'badge-wanita' }}">
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
                        <a href="{{ route('warga.edit', $w->warga_id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('warga.destroy', $w->warga_id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus data warga?')">
                                <i class="fas fa-trash"></i>
                            </button>
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

</div>
@endsection
