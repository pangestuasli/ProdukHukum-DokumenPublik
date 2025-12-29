@extends('layouts.app')
@section('title')
Edit User
@endsection
@section('content')
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Edit User</h1>
            <p class="mb-0">Form untuk mengedit data user.</p>
        </div>
        <div>
            <a href="{{route('user.index')}}" class="btn btn-primary"><i class="far fa-question-circle me-1"></i> Kembali</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow components-section">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{route('user.update', $dataUser->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <!-- Profil Picture Preview -->
                            <div class="mb-3 text-center">
                                <div class="profile-picture-preview mb-3">
                                    <img id="profilPicturePreview" src="{{ $dataUser->profil_picture_url }}" 
                                         alt="Preview Foto Profil" 
                                         class="rounded-circle border" 
                                         style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                            </div>

                            <!-- Foto Profil -->
                            <div class="mb-3">
                                <label for="profil_picture" class="form-label">Foto Profil</label>
                                <input type="file" name="profil_picture" id="profil_picture" 
                                       class="form-control" accept="image/*" onchange="previewImage(event)">
                                <small class="text-muted">Format: jpeg, png, jpg, gif. Maksimal: 2MB</small>
                                @if($dataUser->profil_picture)
                                    <div class="mt-1">
                                        <small>File saat ini: {{ $dataUser->profil_picture }}</small>
                                    </div>
                                @endif
                            </div>

                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input name="name" type="text" id="name" class="form-control" value="{{ old('name', $dataUser->name) }}" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" id="email" class="form-control" value="{{ old('email', $dataUser->email) }}" required>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <small>(Kosongkan jika tidak ingin mengubah)</small></label>
                                <input name="password" type="password" id="password" class="form-control">
                            </div>

                            <!-- Konfirmasi Password -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input name="password_confirmation" type="password" id="password_confirmation" class="form-control">
                            </div>

                            <!-- Role -->
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="">Pilih Role</option>
                                    <option value="admin" {{ old('role', $dataUser->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ old('role', $dataUser->role) == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>

                            <!-- Buttons -->
                            <div class="">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('user.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('profilPicturePreview');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection