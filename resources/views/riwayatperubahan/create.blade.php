@extends('layouts.app')

@section('title', 'Tambah Riwayat Perubahan')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Tambah Riwayat Perubahan</h3>
                    <h6 class="font-weight-normal mb-0">Catat perubahan yang dilakukan pada dokumen</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    {{-- FLASH MESSAGE --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('riwayat-perubahan.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="dokumen_id">Dokumen <span class="text-danger">*</span></label>
                            <select name="dokumen_id" id="dokumen_id" 
                                    class="form-control @error('dokumen_id') is-invalid @enderror" required>
                                <option value="">Pilih Dokumen</option>
                                @foreach($dokumenList as $dokumen)
                                    <option value="{{ $dokumen->dokumen_id }}" 
                                        {{ old('dokumen_id', $selectedDokumen) == $dokumen->dokumen_id ? 'selected' : '' }}>
                                        {{ $dokumen->judul }} ({{ $dokumen->nomor }})
                                    </option>
                                @endforeach
                            </select>
                            @error('dokumen_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal Perubahan <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal" id="tanggal"
                                           class="form-control @error('tanggal') is-invalid @enderror"
                                           value="{{ old('tanggal', date('Y-m-d')) }}"
                                           required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="versi">Versi</label>
                                    <input type="number" name="versi" id="versi"
                                           class="form-control @error('versi') is-invalid @enderror"
                                           value="{{ old('versi') }}"
                                           placeholder="Otomatis (kosongkan untuk versi terbaru)"
                                           min="1">
                                    @error('versi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Kosongkan untuk versi otomatis
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="uraian_perubahan">Uraian Perubahan <span class="text-danger">*</span></label>
                            <textarea name="uraian_perubahan" id="uraian_perubahan"
                                      class="form-control @error('uraian_perubahan') is-invalid @enderror"
                                      rows="5"
                                      placeholder="Jelaskan perubahan yang dilakukan"
                                      required>{{ old('uraian_perubahan') }}</textarea>
                            @error('uraian_perubahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Contoh: "Perubahan pasal 5 tentang ketentuan umum", "Revisi lampiran III"
                            </small>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="mdi mdi-content-save"></i> Simpan
                            </button>
                            <a href="{{ route('riwayat-perubahan.index') }}" class="btn btn-light">
                                <i class="mdi mdi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <i class="mdi mdi-information-outline text-primary"></i> Panduan
                    </h4>
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <p class="text-muted">
                                <strong>Fungsi Riwayat Perubahan:</strong>
                            </p>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="mdi mdi-check-circle text-success me-2"></i>
                                    Mencatat perubahan dokumen
                                </li>
                                <li class="mb-2">
                                    <i class="mdi mdi-check-circle text-success me-2"></i>
                                    Melacak versi dokumen
                                </li>
                                <li class="mb-2">
                                    <i class="mdi mdi-check-circle text-success me-2"></i>
                                    Audit trail untuk compliance
                                </li>
                                <li>
                                    <i class="mdi mdi-check-circle text-success me-2"></i>
                                    Referensi untuk perubahan berikutnya
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-fill version if dokumen selected
        const dokumenSelect = document.getElementById('dokumen_id');
        const versiInput = document.getElementById('versi');
        
        dokumenSelect.addEventListener('change', function() {
            if (this.value && !versiInput.value) {
                // In real app, you might want to fetch via AJAX
                // For now, we'll just leave it empty for auto-generation
            }
        });
    });
</script>

<style>
    .form-control:focus {
        border-color: #4d94ff;
        box-shadow: 0 0 0 0.2rem rgba(77, 148, 255, 0.25);
    }
</style>
@endsection