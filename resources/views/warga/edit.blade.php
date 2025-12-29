@extends('layouts.app')

@section('title', 'Edit Warga')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Warga</h4>
                <form method="POST" action="{{ route('warga.update', $warga->warga_id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="no_ktp">No KTP *</label>
                        <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" 
                               id="no_ktp" name="no_ktp" value="{{ old('no_ktp', $warga->no_ktp) }}" 
                               maxlength="16" required>
                        @error('no_ktp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="nama">Nama Lengkap *</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" name="nama" value="{{ old('nama', $warga->nama) }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Jenis Kelamin *</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" 
                                   id="laki" value="L" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'L' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="laki">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" 
                                   id="perempuan" value="P" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'P' ? 'checked' : '' }}>
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
                            <option value="Islam" {{ old('agama', $warga->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ old('agama', $warga->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ old('agama', $warga->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ old('agama', $warga->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ old('agama', $warga->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ old('agama', $warga->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                        @error('agama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="pekerjaan">Pekerjaan *</label>
                        <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" 
                               id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $warga->pekerjaan) }}" required>
                        @error('pekerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="telp">No. Telepon *</label>
                        <input type="text" class="form-control @error('telp') is-invalid @enderror" 
                               id="telp" name="telp" value="{{ old('telp', $warga->telp) }}" required>
                        @error('telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $warga->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <a href="{{ route('warga.index') }}" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection