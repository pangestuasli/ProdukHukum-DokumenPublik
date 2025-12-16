@extends('layouts.admin.app')

@section('title','Edit Warga')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Warga</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('warga.update',$warga->warga_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>No KTP</label>
                <input type="text" name="no_ktp"
                       value="{{ $warga->no_ktp }}"
                       class="form-control" required>
            </div>

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama"
                       value="{{ $warga->nama }}"
                       class="form-control" required>
            </div>

            <button class="btn btn-success mt-2">Update</button>
            <a href="{{ route('warga.index') }}" class="btn btn-secondary mt-2">Kembali</a>
        </form>
    </div>
</div>
@endsection
