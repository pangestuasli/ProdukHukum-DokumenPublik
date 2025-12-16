@extends('layouts.admin.app')


@section('title', 'Tambah Dokumen Hukum')


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Tambah Dokumen Hukum</h4>
        </div>


        <div class="card-body">
            <form action="{{ route('dokumen-hukum.store') }}" method="POST" enctype="multipart/form-data">
                @csrf


                <div class="form-group">
                    <label>Jenis Dokumen</label>
                    <select name="jenis_id" class="form-control" required>
                        <option value="">-- Pilih Jenis --</option>
                        @foreach($jenis as $j)
                            <option value="{{ $j->jenis_id }}">{{ $j->nama_jenis }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label>Kategori Dokumen</label>
                    <select name="kategori_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->kategori_id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label>Nomor Dokumen</label>
                    <input type="text" name="nomor" class="form-control" required>
                </div>


                <div class="form-group">
                    <label>Judul Dokumen</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>


                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>


                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="aktif">Aktif</option>
                        <option value="tidak aktif">Tidak Aktif</option>
                    </select>
                </div>


                <div class="form-group">
                    <label>Ringkasan</label>
                    <textarea name="ringkasan" class="form-control" rows="3"></textarea>
                </div>


                <div class="form-group">
                    <label>File Dokumen (PDF/DOC)</label>
                    <input type="file" name="file_dokumen" class="form-control">
                </div>


                <button class="btn btn-success mt-3">Simpan</button>
                <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </form>
        </div>
    </div>
@endsection