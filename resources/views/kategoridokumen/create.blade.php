@extends('layouts.app')

@section('title', 'Tambah Kategori Dokumen')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Tambah Kategori Dokumen</h3>
                    <h6 class="font-weight-normal mb-0">Isi form di bawah untuk menambahkan kategori dokumen baru</h6>
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

                    <form action="{{ route('kategori-dokumen.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="nama">Nama Kategori <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="nama" 
                                id="nama"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama') }}"
                                placeholder="Masukkan nama kategori"
                                required
                                autofocus
                            >
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Maksimal 100 karakter. Contoh: "Surat Resmi", "Laporan", "Proposal"
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea 
                                name="deskripsi" 
                                id="deskripsi"
                                class="form-control @error('deskripsi') is-invalid @enderror"
                                rows="3"
                                placeholder="Masukkan deskripsi kategori (opsional)"
                            >{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Deskripsi akan membantu memahami tujuan dari kategori ini
                            </small>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="mdi mdi-content-save"></i> Simpan
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
</style>
@endsection