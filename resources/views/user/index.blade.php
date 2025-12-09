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
                    
                    <div class="table-responsive">
                        <table id="table-user" class="table table-hover table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th width="10%">Role</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataUser as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
