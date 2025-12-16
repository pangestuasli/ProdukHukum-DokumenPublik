@extends('layouts.admin.app')


@section('title', 'Tambah Riwayat Perubahan')


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Tambah Riwayat Perubahan</h4>
        </div>


        <div class="card-body">
            <form action="{{ route('riwayat.store') }}" method="POST">
                @csrf


                <input type="hidden" name="dokumen_id" value="{{ $dokumen_id }}">


                <div class="form-group">
                    <label>Tanggal Perubahan</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>


                <div class="form-group">
                    <label>Versi Dokumen</label>
                    <input type="text" name="versi" class="form-control" placeholder="contoh: v1.1" required>
                </div>


                <div class="form-group">
                    <label>Uraian Perubahan</label>
                    <textarea name="uraian_perubahan" class="form-control" rows="4" required></textarea>
                </div>


                <button class="btn btn-success mt-3">Simpan</button>
                <a href="{{ route('riwayat.index', $dokumen_id) }}" class="btn btn-secondary mt-3">Kembali</a>
            </form>
        </div>
    </div>
@endsection