@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Warga</h2>
        <a href="{{ route('warga.create') }}" class="btn btn-primary">+ Tambah Warga</a>
    </div>

    {{-- Flash Success --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Flash Error --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">

            {{-- Search --}}
            <form method="GET" action="{{ route('warga.index') }}" class="p-3 d-flex gap-2 flex-wrap">
                <input type="text" name="search" class="form-control"
                       placeholder="Cari nama atau No KTP..."
                       value="{{ request('search') }}">
                <button class="btn btn-primary">Cari</button>
                @if(request('search'))
                    <a href="{{ route('warga.index') }}" class="btn btn-secondary">Reset</a>
                @endif
            </form>

            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="60">Foto</th>
                        <th>No KTP</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Pekerjaan</th>
                        <th>Telp</th>
                        <th>Email</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($wargas as $w)
                        <tr>
                            <td>
                                @if($w->foto)
                                    <img src="{{ asset('uploads/warga/'.$w->foto) }}" width="40" class="rounded" alt="Foto {{ $w->nama }}">
                                @else
                                    <span class="text-muted">Belum ada</span>
                                @endif
                            </td>
                            <td>{{ $w->no_ktp }}</td>
                            <td>{{ $w->nama }}</td>
                            <td>{{ $w->jenis_kelamin }}</td>
                            <td>{{ $w->agama }}</td>
                            <td>{{ $w->pekerjaan }}</td>
                            <td>{{ $w->telp }}</td>
                            <td>{{ $w->email }}</td>
                            <td>
                                <a href="{{ route('warga.show', $w) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('warga.edit', $w) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('warga.destroy', $w) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-3">Belum ada data warga.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-3 d-flex justify-content-center">
                {!! $wargas->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>

</div>
@endsection
