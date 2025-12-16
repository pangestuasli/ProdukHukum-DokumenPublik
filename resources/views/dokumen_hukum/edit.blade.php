@extends('layouts.admin.app')


@section('title', 'Edit Dokumen Hukum')


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit Dokumen Hukum</h4>
        </div>


        <div class="card-body">
            <form action="{{ route('dokumen-hukum.update', $dokumen->dokumen_id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')


                <div class="form-group">
                    <label>Jenis Dokumen</label>
                    <select name="jenis_id" class="form-control" required>
                        @foreach($jenis as $j)
                            <option value="{{ $j->jenis_id }}" {{ $dokumen->jenis_id == $j->jenis_id ? 'selected' : '' }}>
                                {{ $j->nama_jenis }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label>Kategori Dokumen</label>
                    <select name="kategori_id" class="form-control" required>
                        @foreach($kategori as $k)
                            <option value="{{ $k->kategori_id }}" {{ $dokumen->kategori_id == $k->kategori_id ? 'selected' : '' }}>
                                {{ $k->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label>Nomor Dokumen</label>
                    <input type="text" name="nomor" value="{{ $dokumen->nomor }}" class="form-control" required>
                </div>


                <div class="form-group">
                    <label>Judul Dokumen</label>
                    <input type="text" name="judul" value="{{ $dokumen->judul }}" class="form-control" required>
                </div>


                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" value="{{ $dokumen->tanggal }}" class="form-control" required>
                </div>


                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="aktif" {{ $dokumen->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak aktif" {{ $dokumen->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>


                <div class="form-group">
                    <label>Ringkasan</label>
                    <textarea name="ringkasan" class="form-control" rows="3">{{ $dokumen->ringkasan }}</textarea>
                </div>


                <div class="form-group">
                    <label>File Dokumen</label><br>
                    @if($dokumen->file_dokumen)
                        <a href="{{ asset('storage/' . $dokumen->file_dokumen) }}" target="_blank">Lihat File Saat Ini</a>
                    @endif
                    <input type="file" name="file_dokumen" class="form-control mt-2">
                </div>


                <button class="btn btn-success mt-3">Update</button>
                <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </form>
        </div>
    </div>
@endsection