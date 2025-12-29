@extends('layouts.app')

@section('title', 'Tambah Dokumen')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12">
                    <h3 class="font-weight-bold">Tambah Dokumen Hukum</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('dokumen-hukum.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Dokumen <span class="text-danger">*</span></label>
                                    <select name="jenis_id" class="form-control" required>
                                        <option value="">Pilih Jenis</option>
                                        @foreach($jenisDokumen as $jenis)
                                        <option value="{{ $jenis->jenis_id }}" {{ old('jenis_id') == $jenis->jenis_id ? 'selected' : '' }}>
                                            {{ $jenis->nama_jenis }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kategori <span class="text-danger">*</span></label>
                                    <select name="kategori_id" class="form-control" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategoriDokumen as $kategori)
                                        <option value="{{ $kategori->kategori_id }}" {{ old('kategori_id') == $kategori->kategori_id ? 'selected' : '' }}>
                                            {{ $kategori->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Dokumen <span class="text-danger">*</span></label>
                                    <input type="text" name="nomor" class="form-control" value="{{ old('nomor') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Judul Dokumen <span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Ringkasan</label>
                            <textarea name="ringkasan" class="form-control" rows="3">{{ old('ringkasan') }}</textarea>
                        </div>

                        {{-- UPLOAD FILE --}}
                        <div class="form-group">
                            <label>File Utama <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="file_utama" class="custom-file-input" id="fileInput" required>
                                    <label class="custom-file-label" for="fileInput">Pilih file...</label>
                                </div>
                            </div>
                            <small class="form-text text-muted">
                                Format: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG. Maks: 5MB
                            </small>
                        </div>

                        <div class="form-group">
                            <label>Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control" required>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="publik" {{ old('status') == 'publik' ? 'selected' : '' }}>Publik</option>
                                <option value="arsip" {{ old('status') == 'arsip' ? 'selected' : '' }}>Arsip</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
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

<script>
// Tampilkan nama file di input
document.getElementById('fileInput').addEventListener('change', function(e) {
    var fileName = e.target.files[0].name;
    var nextSibling = e.target.nextElementSibling;
    nextSibling.innerText = fileName;
});
</script>

<style>
    .custom-file-label::after {
        content: "Browse";
    }
</style>
@endsection