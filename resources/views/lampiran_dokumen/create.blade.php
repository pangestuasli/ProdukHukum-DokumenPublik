@extends('layouts.admin.app')

@section('title', 'Tambah Lampiran Dokumen')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Lampiran Dokumen</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('lampiran-dokumen.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="dokumen_id" class="form-label">Dokumen Hukum</label>
                            <select name="dokumen_id" id="dokumen_id" class="form-control" required>
                                <option value="">Pilih Dokumen</option>
                                @foreach($dokumen as $d)
                                    <option value="{{ $d->dokumen_id }}">{{ $d->judul }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="media" class="form-label">File Lampiran</label>
                            <input type="file" name="media" id="media" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
                            <small class="text-muted">Format: PDF, DOC, DOCX, JPG, JPEG, PNG. Max: 2MB</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('lampiran-dokumen.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection