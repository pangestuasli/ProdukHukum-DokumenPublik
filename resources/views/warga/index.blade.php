@extends('layouts.app')

@section('title', 'Data Warga')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">Data Warga</h4>
                    <a href="{{ route('warga.create') }}" class="btn btn-primary btn-icon-text">
                        <i class="ti-plus btn-icon-prepend"></i>
                        Tambah Warga
                    </a>
                </div>

                {{-- Filter Section --}}
                <div class="row mb-3">
                    <div class="col-md-8">
                        {{-- Search Form --}}
                        <form method="GET" action="{{ route('warga.index') }}" class="d-flex gap-2">
                            <input type="hidden" name="jenis_kelamin" value="{{ request('jenis_kelamin') }}">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama atau NIK..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Cari
                            </button>
                            @if(request('search'))
                                <a href="{{ route('warga.index', ['jenis_kelamin' => request('jenis_kelamin')]) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </form>
                    </div>
                    <div class="col-md-4">
                        {{-- Filter Form --}}
                        <form method="GET" action="{{ route('warga.index') }}" class="d-flex gap-2">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Jenis Kelamin</option>
                                <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @if(request('jenis_kelamin'))
                                <a href="{{ route('warga.index', ['search' => request('search')]) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </form>
                    </div>
                </div>

                {{-- Active Filters Info --}}
                @if(request('search') || request('jenis_kelamin'))
                <div class="alert alert-info mb-3">
                    <strong>Filter Aktif:</strong>
                    @if(request('search'))
                        <span class="badge bg-primary">Pencarian: {{ request('search') }}</span>
                    @endif
                    @if(request('jenis_kelamin'))
                        <span class="badge bg-primary">
                            {{ request('jenis_kelamin') == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </span>
                    @endif
                    <a href="{{ route('warga.index') }}" class="btn btn-sm btn-outline-dark ms-2">Reset Semua</a>
                </div>
                @endif
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No KTP</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Agama</th>
                                <th>Pekerjaan</th>
                                <th>Telp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($wargas as $warga)
                            <tr>
                                <td>{{ $loop->iteration + (($wargas->currentPage() - 1) * $wargas->perPage()) }}</td>
                                <td>{{ $warga->no_ktp }}</td>
                                <td>{{ $warga->nama }}</td>
                                <td>{{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $warga->agama }}</td>
                                <td>{{ $warga->pekerjaan }}</td>
                                <td>{{ $warga->telp }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('warga.show', $warga->warga_id) }}" class="btn btn-info btn-sm">
                                            <i class="ti-eye"></i>
                                        </a>
                                        <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-warning btn-sm">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <form action="{{ route('warga.destroy', $warga->warga_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                                <i class="ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data warga</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>                
                <div class="mt-4 d-flex justify-content-between align-items-center">
                    <div>
                        Menampilkan {{ $wargas->firstItem() ?? 0 }} - {{ $wargas->lastItem() ?? 0 }} dari {{ $wargas->total() }} data
                    </div>
                    <div>
                        {{ $wargas->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection