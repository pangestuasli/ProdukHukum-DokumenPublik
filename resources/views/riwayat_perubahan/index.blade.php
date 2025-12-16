@extends('layouts.admin.app')


@section('title', 'Riwayat Perubahan Dokumen')


@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Riwayat Perubahan Dokumen</h4>
            <a href="{{ route('riwayat.create', $dokumen->dokumen_id) }}" class="btn btn-primary">
                Tambah Riwayat
            </a>
        </div>


        <div class="card-body">
            <div class="mb-3">
                <strong>Dokumen:</strong> {{ $dokumen->judul }} <br>
                <strong>Nomor:</strong> {{ $dokumen->nomor }}
            </div>


            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Versi</th>
                        <th>Uraian Perubahan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayat as $r)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $r->tanggal }}</td>
                            <td>{{ $r->versi }}</td>
                            <td>{{ $r->uraian_perubahan }}</td>
                            <td>
                                <a href="{{ route('riwayat.edit', $r->riwayat_id) }}" class="btn btn-warning btn-sm">Edit</a>


                                <form action="{{ route('riwayat.destroy', $r->riwayat_id) }}" method="POST"
                                    style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus riwayat ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada riwayat perubahan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>


            <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-secondary mt-3">Kembali ke Dokumen</a>
        </div>
    </div>
@endsection