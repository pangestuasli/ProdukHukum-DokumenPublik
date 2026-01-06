@extends('layouts.app')
@section('title', 'Data User')
@section('content')

<div class="compact-view">
    <div class="py-3">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-2 mb-lg-0">
                <h1 class="h5 mb-1">Data User</h1>
                <p class="text-muted small mb-0">List data seluruh User</p>
            </div>
            <div>
                <a href="{{ route('user.create') }}" class="btn btn-success btn-sm text-white">
                    <i class="mdi mdi-plus-circle me-1"></i>
                    Tambah User
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Filter & Search Section --}}
                    <div class="row mb-3">
                        <div class="col-md-8">
                            {{-- Search Form --}}
                            <form method="GET" action="{{ route('user.index') }}" class="d-flex gap-2">
                                <input type="hidden" name="role" value="{{ request('role') }}">
                                <input type="text" name="search" class="form-control form-control-sm" 
                                       placeholder="Cari nama atau email..." 
                                       value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="mdi mdi-magnify"></i> Cari
                                </button>
                                @if(request('search'))
                                    <a href="{{ route('user.index', ['role' => request('role')]) }}" 
                                       class="btn btn-outline-secondary btn-sm">
                                        <i class="mdi mdi-close"></i>
                                    </a>
                                @endif
                            </form>
                        </div>
                        <div class="col-md-4">
                            {{-- Filter Role --}}
                            <form method="GET" action="{{ route('user.index') }}" class="d-flex gap-2">
                                <input type="hidden" name="search" value="{{ request('search') }}">
                                <select name="role" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="">Semua Role</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                                @if(request('role'))
                                    <a href="{{ route('user.index', ['search' => request('search')]) }}" 
                                       class="btn btn-outline-secondary btn-sm">
                                        <i class="mdi mdi-close"></i>
                                    </a>
                                @endif
                            </form>
                        </div>
                    </div>

                    {{-- Active Filters Info --}}
                    @if(request('search') || request('role'))
                    <div class="alert alert-light py-2 mb-3">
                        <div class="d-flex align-items-center">
                            <span class="me-2">
                                <i class="mdi mdi-filter text-primary"></i>
                                <strong>Filter aktif:</strong>
                            </span>
                            <div class="d-flex flex-wrap gap-2">
                                @if(request('search'))
                                    <span class="badge bg-info">
                                        <i class="mdi mdi-magnify me-1"></i>
                                        "{{ request('search') }}"
                                    </span>
                                @endif
                                @if(request('role'))
                                    <span class="badge bg-info">
                                        <i class="mdi mdi-account me-1"></i>
                                        {{ ucfirst(request('role')) }}
                                    </span>
                                @endif
                                <a href="{{ route('user.index') }}" class="badge bg-danger text-decoration-none">
                                    <i class="mdi mdi-close-circle me-1"></i>
                                    Reset Semua
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <div class="table-responsive">
                        <table id="table-user" class="table table-hover table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Foto</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th width="10%">Role</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataUser as $item)
                                    <tr>
                                        <td>{{ $loop->iteration + (($dataUser->currentPage() - 1) * $dataUser->perPage()) }}</td>
                                        <td>
                                            <img src="{{ $item->profil_picture_url }}" 
                                                 alt="{{ $item->name }}" 
                                                 class="rounded-circle border" 
                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            <span class="badge bg-{{ $item->role == 'admin' ? 'danger' : 'primary' }}">
                                                {{ $item->role == 'admin' ? 'Admin' : 'User' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('user.edit', $item->id) }}" 
                                                   class="btn btn-info btn-sm py-1 px-2" 
                                                   title="Edit" data-bs-toggle="tooltip">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                
                                                <form action="{{ route('user.destroy', $item->id) }}" 
                                                      method="POST" 
                                                      class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-danger btn-sm py-1 px-2" 
                                                            title="Hapus" 
                                                            data-bs-toggle="tooltip"
                                                            onclick="return confirm('Yakin hapus user {{ $item->name }}?')">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="mdi mdi-account-alert-outline mdi-48px"></i>
                                                <h5 class="mt-3">Tidak ada data user</h5>
                                                @if(request()->hasAny(['search', 'role']))
                                                    <p class="mb-3">Tidak ada hasil untuk filter yang dipilih</p>
                                                    <a href="{{ route('user.index') }}" class="btn btn-primary btn-sm">
                                                        <i class="mdi mdi-refresh"></i> Reset Filter
                                                    </a>
                                                @else
                                                    <p>Mulai dengan menambahkan user baru</p>
                                                    <a href="{{ route('user.create') }}" class="btn btn-success btn-sm">
                                                        <i class="mdi mdi-plus-circle"></i> Tambah User Pertama
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted small">
                            Menampilkan {{ $dataUser->firstItem() ?? 0 }} - {{ $dataUser->lastItem() ?? 0 }} 
                            dari {{ $dataUser->total() }} user
                        </div>
                        <div>
                            {{ $dataUser->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .alert-light {
        background-color: #f8f9fa;
        border-color: #e9ecef;
    }
    .badge a {
        text-decoration: none;
    }
    .badge a:hover {
        opacity: 0.8;
    }
</style>

@endsection