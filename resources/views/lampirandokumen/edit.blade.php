@extends('layouts.app')

@section('title', 'Edit Lampiran Dokumen Hukum')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Lampiran Dokumen Hukum</h4>
                <form method="POST" action="{{ route('lampiran-dokumen.update', $lampiran->lampiran_id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="dokumen_id">Dokumen Hukum</label>
                        <select class="form-control @error('dokumen_id') is-invalid @enderror" 
                                id="dokumen_id" name="dokumen_id" required>
                            <option value="">-- Pilih Dokumen Hukum --</option>
                            @foreach($dokumenList as $dokumen)
                            <option value="{{ $dokumen->dokumen_id }}" 
                                    {{ old('dokumen_id', $lampiran->dokumen_id) == $dokumen->dokumen_id ? 'selected' : '' }}>
                                {{ $dokumen->nomor ? $dokumen->nomor . ' - ' . $dokumen->judul : $dokumen->judul }}
                            </option>
                            @endforeach
                        </select>
                        @error('dokumen_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="berkas_lampiran">File Lampiran</label>
                        <div class="custom-file">
                            <input type="file" 
                                   class="custom-file-input @error('berkas_lampiran') is-invalid @enderror" 
                                   id="berkas_lampiran" name="berkas_lampiran">
                            <label class="custom-file-label" for="berkas_lampiran">
                                {{ $lampiran->berkas_lampiran ?: 'Pilih file baru (opsional)' }}
                            </label>
                        </div>
                        <small class="form-text text-muted">
                            Biarkan kosong jika tidak ingin mengubah file. 
                            Format: PDF, JPG, JPEG, PNG, DOC, DOCX, XLS, XLSX (Max: 2MB)
                        </small>
                        @if($lampiran->berkas_lampiran)
                        @endif
                        @error('berkas_lampiran')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                  id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $lampiran->keterangan) }}</textarea>
                        @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="ti-save"></i> Update
                        </button>
                        <a href="{{ route('lampiran-dokumen.show', $lampiran->lampiran_id) }}" 
                           class="btn btn-secondary mr-2">
                            <i class="ti-close"></i> Batal
                        </a>
                        <a href="{{ route('lampiran-dokumen.index') }}" class="btn btn-light">
                            <i class="ti-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Update custom file input label
document.querySelector('.custom-file-input').addEventListener('change', function(e) {
    var fileName = e.target.files[0] ? e.target.files[0].name : 'Pilih file baru (opsional)';
    var label = e.target.nextElementSibling;
    label.innerText = fileName;
});
</script>
@endpush