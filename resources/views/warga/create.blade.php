@extends('layouts.app')

@section('title', 'Tambah Warga')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Warga</h4>
                <form method="POST" action="{{ route('warga.store') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="no_ktp">No KTP *</label>
                        <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" 
                               id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}" 
                               maxlength="16" required>
                        @error('no_ktp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="nama">Nama Lengkap *</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" name="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Jenis Kelamin *</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" 
                                   id="laki" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="laki">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" 
                                   id="perempuan" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>
                            <label class="form-check-label" for="perempuan">Perempuan</label>
                        </div>
                        @error('jenis_kelamin')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="agama">Agama *</label>
                        <select class="form-control @error('agama') is-invalid @enderror" 
                                id="agama" name="agama" required>
                            <option value="">Pilih Agama</option>
                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                        @error('agama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="pekerjaan">Pekerjaan *</label>
                        <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" 
                               id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}" required>
                        @error('pekerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="telp">No. Telepon *</label>
                        <input type="text" class="form-control @error('telp') is-invalid @enderror" 
                               id="telp" name="telp" value="{{ old('telp') }}" required>
                        @error('telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                    <a href="{{ route('warga.index') }}" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection