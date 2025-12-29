@extends('layouts.app')

@section('title', 'Detail Warga')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Data Warga</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No KTP</label>
                            <p class="form-control-static">{{ $warga->no_ktp }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <p class="form-control-static">{{ $warga->nama }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <p class="form-control-static">
                                {{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Agama</label>
                            <p class="form-control-static">{{ $warga->agama }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <p class="form-control-static">{{ $warga->pekerjaan }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No. Telepon</label>
                            <p class="form-control-static">{{ $warga->telp }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <p class="form-control-static">{{ $warga->email ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Didaftarkan</label>
                            <p class="form-control-static">{{ $warga->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('warga.index') }}" class="btn btn-light">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection