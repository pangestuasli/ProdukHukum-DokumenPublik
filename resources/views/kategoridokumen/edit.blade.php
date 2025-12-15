@extends('layouts.app')

@section('title', 'Edit Kategori Dokumen')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Edit Kategori Dokumen</h3>
                    <h6 class="font-weight-normal mb-0">Perbarui data kategori: {{ $kategoriDokumen->nama }}</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    {{-- FLASH MESSAGE --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('kategori-dokumen.update', $kategoriDokumen->kategori_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama">Nama Kategori <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="nama" 
                                id="nama"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $kategoriDokumen->nama) }}"
                                placeholder="Masukkan nama kategori"
                                required
                                autofocus
                            >
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea 
                                name="deskripsi" 
                                id="deskripsi"
                                class="form-control @error('deskripsi') is-invalid @enderror"
                                rows="3"
                                placeholder="Masukkan deskripsi kategori"
                            >{{ old('deskripsi', $kategoriDokumen->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">Informasi Sistem</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <small class="text-muted d-block">ID Kategori</small>
                                                <span class="badge badge-info">{{ $kategoriDokumen->kategori_id }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted d-block">Dibuat</small>
                                                <small>{{ $kategoriDokumen->created_at->format('d/m/Y H:i') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="mdi mdi-content-save"></i> Perbarui
                            </button>
                            <a href="{{ route('kategori-dokumen.index') }}" class="btn btn-light">
                                <i class="mdi mdi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #4d94ff;
        box-shadow: 0 0 0 0.2rem rgba(77, 148, 255, 0.25);
    }
    .invalid-feedback {
        display: block;
    }
    .badge-info {
        background-color: #17a2b8;
    }
</style>
@endsection