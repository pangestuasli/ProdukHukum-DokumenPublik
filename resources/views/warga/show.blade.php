@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Detail Warga</h2>
        <a href="{{ route('warga.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-3">
                    <strong>Foto Profil:</strong><br>
                    @if($warga->foto)
                        <img src="{{ asset('uploads/warga/'.$warga->foto) }}" class="img-fluid rounded" alt="Foto {{ $warga->nama }}">
                    @else
                        <span class="text-muted">Belum ada foto</span>
                    @endif
                </div>
                <div class="col-md-9">
                    <table class="table table-borderless">
                        <tr>
                            <th width="150">No KTP</th>
                            <td>{{ $warga->no_ktp }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $warga->nama }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $warga->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>{{ $warga->agama }}</td>
                        </tr>
                        <tr>
                            <th>Pekerjaan</th>
                            <td>{{ $warga->pekerjaan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td>{{ $warga->telp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $warga->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>File Pendukung</th>
                            <td>
                                @if($warga->files->count() > 0)
                                    <ul class="mb-0">
                                        @foreach($warga->files as $file)
                                            <li>
                                                <a href="{{ asset('uploads/warga/files/'.$file->file) }}" target="_blank">{{ $file->file }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted">Tidak ada file</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
