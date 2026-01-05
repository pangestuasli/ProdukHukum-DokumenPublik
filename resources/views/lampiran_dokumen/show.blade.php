@extends('layouts.admin.app')

@section('title', 'Detail Lampiran Dokumen')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Lampiran Dokumen</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Dokumen Hukum:</strong> {{ $lampiran->dokumen->judul }}
                    </div>
                    <div class="mb-3">
                        <strong>Keterangan:</strong> {{ $lampiran->keterangan }}
                    </div>
                    <div class="mb-3">
                        <strong>File:</strong> <a href="{{ Storage::url($lampiran->media) }}" target="_blank">{{ basename($lampiran->media) }}</a>
                    </div>
                    <div class="mb-3">
                        <strong>Dibuat:</strong> {{ $lampiran->created_at->format('d/m/Y H:i') }}
                    </div>
                    <div class="mb-3">
                        <strong>Diupdate:</strong> {{ $lampiran->updated_at->format('d/m/Y H:i') }}
                    </div>
                    <a href="{{ route('lampiran-dokumen.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection