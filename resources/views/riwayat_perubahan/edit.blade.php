@extends('layouts.admin.app')


@section('title', 'Edit Riwayat Perubahan')


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit Riwayat Perubahan</h4>
        </div>


        <div class="card-body">
            <form action="{{ route('riwayat.update', $riwayat->riwayat_id) }}" method="POST">
                @csrf
                @method('PUT')


                <div class="form-group">
                    <label>Tanggal Perubahan</label>
                    <input type="date" name="tanggal" value="{{ $riwayat->tanggal }}" class="form-control" required>
                </div>


                <div class="form-group">
                    <label>Versi Dokumen</label>
                    <input type="text" name="versi" value="{{ $riwayat->versi }}" class="form-control" required>
                </div>


                <div class="form-group">
                    <label>Uraian Perubahan</label>
                    <textarea name="uraian_perubahan" class="form-control" rows="4"
                        required>{{ $riwayat->uraian_perubahan }}</textarea>
                </div>


                <button class="btn btn-success mt-3">Update</button>
                <a href="{{ route('riwayat.index', $riwayat->dokumen_id) }}" class="btn btn-secondary mt-3">Kembali</a>
            </form>
        </div>
    </div>
@endsection