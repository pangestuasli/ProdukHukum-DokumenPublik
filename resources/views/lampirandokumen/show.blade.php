@extends('layouts.app')

@section('title', 'Detail Lampiran Dokumen Hukum')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Lampiran Dokumen Hukum</h4>
                
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">ID Lampiran</th>
                                <td>{{ $lampiran->lampiran_id }}</td>
                            </tr>
                            <tr>
                                <th>Dokumen Hukum</th>
                                <td>
                                    @if($lampiran->dokumenHukum)
                                        <strong>{{ $lampiran->dokumenHukum->judul }}</strong><br>
                                        <small class="text-muted">
                                            No: {{ $lampiran->dokumenHukum->nomor ?? '-' }} | 
                                            Tanggal: {{ $lampiran->dokumenHukum->tanggal ? $lampiran->dokumenHukum->tanggal->format('d/m/Y') : '-' }}
                                        </small>
                                    @else
                                        <span class="text-danger">Dokumen tidak ditemukan</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>File Lampiran</th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @php
                                            $icon = match($lampiran->tipe_file) {
                                                'pdf' => 'ti-file',
                                                'jpg', 'jpeg', 'png', 'gif' => 'ti-image',
                                                'doc', 'docx' => 'ti-file',
                                                'xls', 'xlsx' => 'ti-layout-grid2',
                                                default => 'ti-file'
                                            };
                                        @endphp
                                        <i class="ti {{ $icon }} mr-2 fa-2x"></i>
                                        <div>
                                            <strong>{{ $lampiran->berkas_lampiran }}</strong><br>
                                            <small>Ukuran: {{ $lampiran->file_size }}</small>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>{{ $lampiran->keterangan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Upload</th>
                                <td>{{ $lampiran->created_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                            <tr>
                                <th>Terakhir Update</th>
                                <td>{{ $lampiran->updated_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">File Preview</h5>
                                
                                @if(in_array($lampiran->tipe_file, ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ $lampiran->berkas_url }}" 
                                     alt="Preview" 
                                     class="img-fluid rounded mb-3"
                                     style="max-height: 200px;">
                                @else
                                <div class="display-1 text-muted my-4">
                                    <i class="ti-file"></i>
                                </div>
                                <p class="text-muted">
                                    Preview tidak tersedia untuk file {{ strtoupper($lampiran->tipe_file) }}
                                </p>
                                @endif
                                
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('lampiran-dokumen.edit', $lampiran->lampiran_id) }}" 
                       class="btn btn-warning">
                        <i class="ti-pencil"></i> Edit
                    </a>
                    <form action="{{ route('lampiran-dokumen.destroy', $lampiran->lampiran_id) }}" 
                          method="POST" class="d-inline" 
                          onsubmit="return confirm('Hapus lampiran ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="ti-trash"></i> Hapus
                        </button>
                    </form>
                    <a href="{{ route('lampiran-dokumen.index') }}" class="btn btn-light float-right">
                        <i class="ti-arrow-left"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection