@extends('layouts.app')

@section('title', 'Tambah Dokumen Hukum')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Tambah Dokumen Hukum</h3>
                    <h6 class="font-weight-normal mb-0">Isi form di bawah untuk menambahkan dokumen hukum baru</h6>
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

                    <form action="{{ route('dokumen-hukum.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_id">Jenis Dokumen <span class="text-danger">*</span></label>
                                    <select name="jenis_id" id="jenis_id" 
                                            class="form-control @error('jenis_id') is-invalid @enderror" required>
                                        <option value="">Pilih Jenis Dokumen</option>
                                        @foreach($jenisDokumen as $jenis)
                                            <option value="{{ $jenis->jenis_id }}" 
                                                {{ old('jenis_id') == $jenis->jenis_id ? 'selected' : '' }}>
                                                {{ $jenis->nama_jenis }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kategori_id">Kategori <span class="text-danger">*</span></label>
                                    <select name="kategori_id" id="kategori_id" 
                                            class="form-control @error('kategori_id') is-invalid @enderror" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategoriDokumen as $kategori)
                                            <option value="{{ $kategori->kategori_id }}" 
                                                {{ old('kategori_id') == $kategori->kategori_id ? 'selected' : '' }}>
                                                {{ $kategori->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nomor">Nomor Dokumen <span class="text-danger">*</span></label>
                                    <input type="text" name="nomor" id="nomor"
                                           class="form-control @error('nomor') is-invalid @enderror"
                                           value="{{ old('nomor') }}"
                                           placeholder="Masukkan nomor dokumen"
                                           required>
                                    @error('nomor')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal" id="tanggal"
                                           class="form-control @error('tanggal') is-invalid @enderror"
                                           value="{{ old('tanggal') }}"
                                           required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="judul">Judul Dokumen <span class="text-danger">*</span></label>
                            <input type="text" name="judul" id="judul"
                                   class="form-control @error('judul') is-invalid @enderror"
                                   value="{{ old('judul') }}"
                                   placeholder="Masukkan judul dokumen"
                                   required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="ringkasan">Ringkasan</label>
                            <textarea name="ringkasan" id="ringkasan"
                                      class="form-control @error('ringkasan') is-invalid @enderror"
                                      rows="4"
                                      placeholder="Masukkan ringkasan dokumen (opsional)">{{ old('ringkasan') }}</textarea>
                            @error('ringkasan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" 
                                    class="form-control @error('status') is-invalid @enderror" required>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="publik" {{ old('status') == 'publik' ? 'selected' : '' }}>Publik</option>
                                <option value="arsip" {{ old('status') == 'arsip' ? 'selected' : '' }}>Arsip</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="mdi mdi-content-save"></i> Simpan
                            </button>
                            <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-light">
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