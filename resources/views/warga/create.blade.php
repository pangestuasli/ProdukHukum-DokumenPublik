@extends('layouts.admin.app')

@section('title','Tambah Warga')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Tambah Warga</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('warga.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>No KTP</label>
                <input type="text" name="no_ktp" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>

             <div class="form-group">
                <label>Agama</label>
                <input type="text" name="agama" class="form-control" required>
            </div>

             <div class="form-group">
                <label>Pekerjaan</label>
                <input type="text" name="pekerjaan" class="form-control" required>
            </div>

             <div class="form-group">
                <label>No Telp</label>
                <input type="text" name="telp" class="form-control" required>
            </div>

             <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" required>
            </div>

            <button class="btn btn-success mt-2">Simpan</button>
            <a href="{{ route('warga.index') }}" class="btn btn-secondary mt-2">Kembali</a>
        </form>
    </div>
</div>
@endsection
