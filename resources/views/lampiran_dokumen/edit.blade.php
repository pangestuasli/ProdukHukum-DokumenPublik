@extends('layouts.admin.app')

@section('title', 'Edit Lampiran Dokumen')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Lampiran Dokumen</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('lampiran-dokumen.update', $lampiran->lampiran_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="dokumen_id" class="form-label">Dokumen Hukum</label>
                            <select name="dokumen_id" id="dokumen_id" class="form-control" required>
                                <option value="">Pilih Dokumen</option>
                                @foreach($dokumen as $d)
                                    <option value="{{ $d->dokumen_id }}" {{ $lampiran->dokumen_id == $d->dokumen_id ? 'selected' : '' }}>{{ $d->judul }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control" value="{{ $lampiran->keterangan }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="media" class="form-label">File Lampiran</label>
                            <input type="file" name="media" id="media" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file. Format: PDF, DOC, DOCX, JPG, JPEG, PNG. Max: 2MB</small>
                            @if($lampiran->media)
                                <br><small>File saat ini: <a href="{{ Storage::url($lampiran->media) }}" target="_blank">{{ basename($lampiran->media) }}</a></small>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('lampiran-dokumen.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection