@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0">Edit Jenis Dokumen</h4>
        </div>

        <div class="card-body">

            {{-- Global error alert --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Periksa kembali inputan Anda:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('jenis_dokumen.update', $jenis_dokumen->jenis_id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama Jenis -->
                <div class="mb-3">
                    <label class="form-label">Nama Jenis</label>
                    <input
                        type="text"
                        name="nama_jenis"
                        value="{{ old('nama_jenis', $jenis_dokumen->nama_jenis) }}"
                        class="form-control @error('nama_jenis') is-invalid @enderror"
                        required
                    >
                    @error('nama_jenis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea
                        name="deskripsi"
                        class="form-control @error('deskripsi') is-invalid @enderror"
                        rows="3"
                    >{{ old('deskripsi', $jenis_dokumen->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('jenis_dokumen.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        Perbarui
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
