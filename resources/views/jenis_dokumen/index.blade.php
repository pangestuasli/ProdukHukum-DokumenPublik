@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Jenis Dokumen</h2>
        <a href="{{ route('jenis_dokumen.create') }}" class="btn btn-primary">
            + Tambah Jenis Dokumen
        </a>
    </div>

    {{-- Flash Success --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Flash Error --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">

                <form method="GET" action="{{ route('jenis_dokumen.index') }}" class="p-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" 
                       placeholder="Cari nama jenis atau deskripsi..."
                       value="{{ request('search') }}">

                <button class="btn btn-primary" type="submit">Cari</button>

                @if(request('search'))
                <a href="{{ route('jenis_dokumen.index') }}" class="btn btn-secondary">
                    Reset
                </a>
                @endif
            </div>

             <div class="col-md-3">
            <select name="filter" class="form-control">
                <option value="">-- Filter Deskripsi --</option>

                @foreach($listJenis as $jenis)
                    <option value="{{ $jenis->nama_jenis }}"
                        {{ request('filter') == $jenis->nama_jenis ? 'selected' : '' }}>
                        {{ $jenis->nama_jenis }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- TOMBOL --}}
        <div class="col-md-3 d-flex gap-2">
            <button class="btn btn-primary w-50">Apply</button>

            <a href="{{ route('jenis_dokumen.index') }}" class="btn btn-secondary w-50">
                Reset
            </a>
        </div>
        </form>

            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="80">ID</th>
                        <th>Nama Jenis</th>
                        <th>Deskripsi</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $row)
                        <tr>
                            <td>{{ $row->jenis_id }}</td>
                            <td>{{ e($row->nama_jenis) }}</td>
                            <td>{{ e($row->deskripsi) }}</td>
                            <td>
                                <a href="{{ route('jenis_dokumen.edit', $row->jenis_id) }}" 
                                   class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('jenis_dokumen.destroy', $row->jenis_id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" 
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus data ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">
                                Belum ada data jenis dokumen.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
<div class="mt-3 d-flex justify-content-center">
    {!! $data->links('pagination::bootstrap-5') !!}
</div>
        </div>
    </div>

</div>
@endsection
