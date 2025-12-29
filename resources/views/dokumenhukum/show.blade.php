@extends('layouts.app')

@section('title', 'Detail Dokumen')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        <h4 class="card-title">Detail Dokumen</h4>
                        <div>
                            <a href="{{ route('dokumen-hukum.edit', $dokumenHukum->dokumen_id) }}" class="btn btn-warning">
                                <i class="mdi mdi-pencil"></i> Edit
                            </a>
                            <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-light">
                                <i class="mdi mdi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Nomor</th>
                                    <td>{{ $dokumenHukum->nomor }}</td>
                                </tr>
                                <tr>
                                    <th>Judul</th>
                                    <td>{{ $dokumenHukum->judul }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis</th>
                                    <td>{{ $dokumenHukum->jenisDokumen->nama_jenis ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td>{{ $dokumenHukum->kategoriDokumen->nama ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Tanggal</th>
                                    <td>{{ $dokumenHukum->tanggal->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($dokumenHukum->status == 'publik')
                                            <span class="badge badge-success">Publik</span>
                                        @elseif($dokumenHukum->status == 'draft')
                                            <span class="badge badge-warning">Draft</span>
                                        @else
                                            <span class="badge badge-secondary">Arsip</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dibuat</th>
                                    <td>{{ $dokumenHukum->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($dokumenHukum->ringkasan)
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h5>Ringkasan</h5>
                            <div class="border p-3 bg-light">
                                {!! nl2br(e($dokumenHukum->ringkasan)) !!}
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- FILE SECTION DENGAN PREVIEW GAMBAR --}}
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h5><i class="mdi mdi-file-document mr-2"></i> File Dokumen</h5>
                            @if($dokumenHukum->files->count() > 0)
                                <div class="row">
                                    @foreach($dokumenHukum->files as $file)
                                    @php
                                        // Cek tipe file
                                        $ext = strtolower(pathinfo($file->file_url, PATHINFO_EXTENSION));
                                        $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                                        $isPdf = $ext == 'pdf';
                                        $isDocument = in_array($ext, ['doc', 'docx', 'xls', 'xlsx', 'txt']);
                                        
                                        // URL untuk gambar
                                        $fileUrl = asset('storage/' . $file->file_url);
                                        $fileName = basename($file->file_url);
                                        
                                        // Tentukan icon untuk non-gambar
                                        if ($isImage) {
                                            $icon = 'mdi-file-image-box text-warning';
                                            $type = 'Image File';
                                        } elseif ($isPdf) {
                                            $icon = 'mdi-file-pdf-box text-danger';
                                            $type = 'PDF Document';
                                        } elseif ($isDocument) {
                                            if (in_array($ext, ['doc', 'docx'])) {
                                                $icon = 'mdi-file-word-box text-primary';
                                                $type = 'Word Document';
                                            } elseif (in_array($ext, ['xls', 'xlsx'])) {
                                                $icon = 'mdi-file-excel-box text-success';
                                                $type = 'Excel Spreadsheet';
                                            } else {
                                                $icon = 'mdi-file-document-box text-secondary';
                                                $type = 'Document';
                                            }
                                        } else {
                                            $icon = 'mdi-file-document-box text-secondary';
                                            $type = 'File';
                                        }
                                    @endphp
                                    
                                    <div class="col-md-4 mb-3">
                                        <div class="card file-card">
                                            <div class="card-body text-center">
                                                {{-- Jika file adalah gambar, tampilkan preview --}}
                                                @if($isImage)
                                                    <div class="mb-3">
                                                        <img src="{{ $fileUrl }}" 
                                                             alt="{{ $fileName }}" 
                                                             class="img-fluid rounded shadow-sm"
                                                             style="max-height: 150px; width: auto; object-fit: contain;">
                                                        <div class="mt-2">
                                                            <small class="text-muted">
                                                                <i class="mdi mdi-image mr-1"></i> Preview Image
                                                            </small>
                                                        </div>
                                                    </div>
                                                @else
                                                    {{-- Untuk non-gambar, tampilkan icon --}}
                                                    <div class="mb-3">
                                                        <i class="mdi {{ $icon }}" style="font-size: 48px;"></i>
                                                    </div>
                                                @endif
                                                
                                                {{-- Nama file --}}
                                                <h6 class="text-truncate" title="{{ $fileName }}">
                                                    {{ $fileName }}
                                                </h6>
                                                
                                                {{-- Info file --}}
                                                <div class="text-muted small mb-2">
                                                    {{ $type }}
                                                    @if($file->mime_type)
                                                        <br><small>({{ $file->mime_type }})</small>
                                                    @endif
                                                </div>
                                                
                                                {{-- Badge untuk file utama --}}
                                                @if($file->sort_order == 0)
                                                    <span class="badge badge-primary">
                                                        <i class="mdi mdi-star"></i> File Utama
                                                    </span>
                                                @else
                                                    <span class="badge badge-secondary">
                                                        <i class="mdi mdi-paperclip"></i> Lampiran
                                                    </span>
                                                @endif
                                                
                                                {{-- Caption --}}
                                                @if($file->caption && $file->caption != 'File Utama')
                                                    <div class="mt-2 small">
                                                        <i class="mdi mdi-comment-text-outline mr-1"></i>
                                                        {{ $file->caption }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="mdi mdi-information-outline mr-2"></i>
                                    Tidak ada file yang diupload untuk dokumen ini.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .file-card {
        transition: transform 0.2s;
        border: 1px solid #e0e0e0;
        height: 100%;
    }
    
    .file-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-color: #007bff;
    }
    
    .text-truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 100%;
    }
    
    .badge-primary {
        background-color: #007bff;
        color: white;
    }
    
    .badge-secondary {
        background-color: #6c757d;
        color: white;
    }
    
    .img-fluid {
        max-width: 100%;
        height: auto;
    }
    
    /* Style khusus untuk preview gambar */
    .file-card img {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 5px;
        background-color: #f8f9fa;
    }
</style>
@endsection