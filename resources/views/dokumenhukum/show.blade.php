@extends('layouts.app')

@section('title', 'Detail Dokumen Hukum')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Detail Dokumen Hukum</h3>
                    <h6 class="font-weight-normal mb-0">Informasi lengkap tentang dokumen</h6>
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

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-start">
                                <a href="{{ route('dokumen-hukum.edit', $dokumenHukum->dokumen_id) }}" 
                                   class="btn btn-warning mr-2">
                                    <i class="mdi mdi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('dokumen-hukum.destroy', $dokumenHukum->dokumen_id) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="mdi mdi-delete"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-light">
                                    <i class="mdi mdi-arrow-left"></i> Kembali ke Daftar
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="40%">ID Dokumen</th>
                                            <td>{{ $dokumenHukum->dokumen_id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Dokumen</th>
                                            <td><strong>{{ $dokumenHukum->nomor }}</strong></td>
                                        </tr>
                                        <tr>
                                            <th>Judul Dokumen</th>
                                            <td>{{ $dokumenHukum->judul }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Dokumen</th>
                                            <td>{{ $dokumenHukum->jenisDokumen->nama_jenis ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kategori</th>
                                            <td>{{ $dokumenHukum->kategoriDokumen->nama ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="40%">Tanggal</th>
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
                                            <th>Dibuat Pada</th>
                                            <td>{{ $dokumenHukum->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Terakhir Diubah</th>
                                            <td>{{ $dokumenHukum->updated_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            @if($dokumenHukum->ringkasan)
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <h6>Ringkasan Dokumen</h6>
                                        <div class="border p-3 bg-white rounded">
                                            {!! nl2br(e($dokumenHukum->ringkasan)) !!}
                                        </div>
                                    </div>
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
    .table-borderless th {
        font-weight: 600;
        color: #495057;
    }
    .table-borderless td {
        color: #6c757d;
    }
    .badge-success {
        background-color: #28a745;
    }
    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }
    .badge-secondary {
        background-color: #6c757d;
    }
</style>
@endsection