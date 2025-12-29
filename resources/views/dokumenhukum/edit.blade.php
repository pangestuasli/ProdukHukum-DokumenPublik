@extends('layouts.app')

@section('title', 'Edit Dokumen Hukum')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Edit Dokumen Hukum</h3>
                    <h6 class="font-weight-normal mb-0">Perbarui data dokumen: {{ $dokumenHukum->judul }}</h6>
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

                    {{-- TAMBAHKAN enctype="multipart/form-data" --}}
                    <form action="{{ route('dokumen-hukum.update', $dokumenHukum->dokumen_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_id">Jenis Dokumen <span class="text-danger">*</span></label>
                                    <select name="jenis_id" id="jenis_id" 
                                            class="form-control @error('jenis_id') is-invalid @enderror" required>
                                        <option value="">Pilih Jenis Dokumen</option>
                                        @foreach($jenisDokumen as $jenis)
                                            <option value="{{ $jenis->jenis_id }}" 
                                                {{ old('jenis_id', $dokumenHukum->jenis_id) == $jenis->jenis_id ? 'selected' : '' }}>
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
                                                {{ old('kategori_id', $dokumenHukum->kategori_id) == $kategori->kategori_id ? 'selected' : '' }}>
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
                                           value="{{ old('nomor', $dokumenHukum->nomor) }}"
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
                                           value="{{ old('tanggal', $dokumenHukum->tanggal->format('Y-m-d')) }}"
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
                                   value="{{ old('judul', $dokumenHukum->judul) }}"
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
                                      placeholder="Masukkan ringkasan dokumen">{{ old('ringkasan', $dokumenHukum->ringkasan) }}</textarea>
                            @error('ringkasan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- TAMBAHKAN BAGIAN FILE YANG SUDAH ADA --}}
                        @if($dokumenHukum->mediaFiles && $dokumenHukum->mediaFiles->count() > 0)
                        <div class="form-group">
                            <label>File Terupload</label>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>File</th>
                                            <th>Keterangan</th>
                                            <th>Tipe</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dokumenHukum->mediaFiles as $media)
                                        <tr>
                                            <td>
                                                <i class="mdi {{ $media->getFileIconAttribute() }} mr-2"></i>
                                                {{ basename($media->file_url) }}
                                                @if($media->sort_order == 0)
                                                    <span class="badge badge-primary ml-2">File Utama</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" 
                                                       name="existing_captions[{{ $media->media_id }}]" 
                                                       value="{{ $media->caption }}"
                                                       class="form-control form-control-sm">
                                            </td>
                                            <td>{{ $media->mime_type }}</td>
                                            <td>
                                                <a href="{{ route('dokumen-hukum.media.download', ['dokumen' => $dokumenHukum->dokumen_id, 'media' => $media->media_id]) }}" 
                                                   class="btn btn-sm btn-info" title="Download">
                                                    <i class="mdi mdi-download"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-sm btn-danger hapus-media"
                                                        data-media-id="{{ $media->media_id }}"
                                                        title="Hapus">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif

                        {{-- TAMBAHKAN BAGIAN UPDATE FILE UTAMA --}}
                        <div class="form-group">
                            <label for="file_utama">Update File Utama (Opsional)</label>
                            <small class="form-text text-muted d-block mb-2">
                                Kosongkan jika tidak ingin mengganti file utama. Format: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG. Maksimal: 10MB
                            </small>
                            <input type="file" name="file_utama" id="file_utama"
                                   class="form-control-file @error('file_utama') is-invalid @enderror"
                                   accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
                            @error('file_utama')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- TAMBAHKAN BAGIAN TAMBAH LAMPIRAN BARU --}}
                        <div class="form-group">
                            <label for="lampiran">Tambah Lampiran Baru (Opsional)</label>
                            <small class="form-text text-muted d-block mb-2">
                                Format: PDF, DOC, DOCX, XLS, XLSX, JPG, JPEG, PNG. Maksimal per file: 5MB
                            </small>
                            
                            <div id="lampiran-container">
                                <div class="lampiran-item mb-3">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input type="file" name="lampiran[]" 
                                                   class="form-control-file"
                                                   accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="caption_lampiran[]" 
                                                   class="form-control" 
                                                   placeholder="Keterangan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" class="btn btn-sm btn-outline-secondary mt-2" id="tambah-lampiran">
                                <i class="mdi mdi-plus"></i> Tambah Lampiran
                            </button>
                        </div>

                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" 
                                    class="form-control @error('status') is-invalid @enderror" required>
                                <option value="draft" {{ old('status', $dokumenHukum->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="publik" {{ old('status', $dokumenHukum->status) == 'publik' ? 'selected' : '' }}>Publik</option>
                                <option value="arsip" {{ old('status', $dokumenHukum->status) == 'arsip' ? 'selected' : '' }}>Arsip</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="mdi mdi-content-save"></i> Perbarui
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
document.addEventListener('DOMContentLoaded', function() {
    // Tambah lampiran
    document.getElementById('tambah-lampiran').addEventListener('click', function() {
        const container = document.getElementById('lampiran-container');
        const newItem = document.createElement('div');
        newItem.className = 'lampiran-item mb-3';
        newItem.innerHTML = `
            <div class="row align-items-center">
                <div class="col-md-7">
                    <input type="file" name="lampiran[]" 
                           class="form-control-file"
                           accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
                </div>
                <div class="col-md-4">
                    <input type="text" name="caption_lampiran[]" 
                           class="form-control" 
                           placeholder="Keterangan">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-sm btn-danger hapus-lampiran">
                        <i class="mdi mdi-delete"></i>
                    </button>
                </div>
            </div>
        `;
        container.appendChild(newItem);
    });

    // Hapus lampiran
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('hapus-lampiran') || 
            e.target.closest('.hapus-lampiran')) {
            const lampiranItem = e.target.closest('.lampiran-item');
            if (lampiranItem) {
                lampiranItem.remove();
            }
        }
    });

    // Hapus media dengan konfirmasi
    document.querySelectorAll('.hapus-media').forEach(button => {
        button.addEventListener('click', function() {
            const mediaId = this.getAttribute('data-media-id');
            if (confirm('Apakah Anda yakin ingin menghapus file ini?')) {
                fetch(`/dokumen-hukum/{{ $dokumenHukum->dokumen_id }}/media/${mediaId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Gagal menghapus file');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan');
                });
            }
        });
    });
});
</script>

<style>
    .form-control:focus {
        border-color: #4d94ff;
        box-shadow: 0 0 0 0.2rem rgba(77, 148, 255, 0.25);
    }
    .invalid-feedback {
        display: block;
    }
    .lampiran-item {
        padding: 10px;
        border: 1px dashed #ddd;
        border-radius: 5px;
    }
    .table th, .table td {
        vertical-align: middle;
    }
</style>
@endsection