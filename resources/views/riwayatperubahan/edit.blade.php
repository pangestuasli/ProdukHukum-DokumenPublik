@extends('layouts.app')

@section('title', 'Edit Riwayat Perubahan')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Edit Riwayat Perubahan</h3>
                    <h6 class="font-weight-normal mb-0">Perbarui catatan perubahan dokumen</h6>
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

                    <form action="{{ route('riwayat-perubahan.update', $riwayatPerubahan->riwayat_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="dokumen_id">Dokumen <span class="text-danger">*</span></label>
                            <select name="dokumen_id" id="dokumen_id" 
                                    class="form-control @error('dokumen_id') is-invalid @enderror" required>
                                <option value="">Pilih Dokumen</option>
                                @foreach($dokumenList as $dokumen)
                                    <option value="{{ $dokumen->dokumen_id }}" 
                                        {{ old('dokumen_id', $riwayatPerubahan->dokumen_id) == $dokumen->dokumen_id ? 'selected' : '' }}>
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
                                           value="{{ old('tanggal', $riwayatPerubahan->tanggal->format('Y-m-d')) }}"
                                           required>
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="versi">Versi <span class="text-danger">*</span></label>
                                    <input type="number" name="versi" id="versi"
                                           class="form-control @error('versi') is-invalid @enderror"
                                           value="{{ old('versi', $riwayatPerubahan->versi) }}"
                                           min="1"
                                           required>
                                    @error('versi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="uraian_perubahan">Uraian Perubahan <span class="text-danger">*</span></label>
                            <textarea name="uraian_perubahan" id="uraian_perubahan"
                                      class="form-control @error('uraian_perubahan') is-invalid @enderror"
                                      rows="5"
                                      placeholder="Jelaskan perubahan yang dilakukan"
                                      required>{{ old('uraian_perubahan', $riwayatPerubahan->uraian_perubahan) }}</textarea>
                            @error('uraian_perubahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="mdi mdi-content-save"></i> Perbarui
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
                        <i class="mdi mdi-information-outline text-primary"></i> Informasi
                    </h4>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-borderless">
                                <tr>
                                    <th>ID Riwayat</th>
                                    <td>{{ $riwayatPerubahan->riwayat_id }}</td>
                                </tr>
                                <tr>
                                    <th>Dibuat</th>
                                    <td>{{ $riwayatPerubahan->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Diperbarui</th>
                                    <td>{{ $riwayatPerubahan->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #4d94ff;
        box-shadow: 0 0 0 0.2rem rgba(77, 148, 255, 0.25);
    }
    .table-borderless th {
        font-weight: 600;
        width: 40%;
    }
</style>
@endsection