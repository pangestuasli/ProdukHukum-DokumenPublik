@extends('layouts.app')

@section('title', 'Dokumen Hukum')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Dokumen Hukum</h4>

                        {{-- Flash Message --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between mb-3">
                            <a href="{{ route('dokumen-hukum.create') }}" class="btn btn-primary">
                                <i class="mdi mdi-plus"></i> Tambah Dokumen
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nomor</th>
                                        <th>Judul</th>
                                        <th>Jenis</th>
                                        <th>Kategori</th>
                                        <th>Tanggal</th>
                                        <th>File</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dokumenHukum as $dokumen)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><strong>{{ $dokumen->nomor }}</strong></td>
                                            <td>{{ Str::limit($dokumen->judul, 40) }}</td>
                                            <td>{{ $dokumen->jenisDokumen->nama_jenis ?? '-' }}</td>
                                            <td>{{ $dokumen->kategoriDokumen->nama ?? '-' }}</td>
                                            <td>{{ $dokumen->tanggal->format('d/m/Y') }}</td>
                                            <td>
                                                @if($dokumen->fileUtama)
                                                    <div class="d-flex align-items-center">
                                                        @php
                                                            // Ambil file
                                                            $file = $dokumen->fileUtama;

                                                            // Ambil ekstensi file
                                                            $ext = pathinfo($file->file_url, PATHINFO_EXTENSION);
                                                            $ext = strtolower($ext);

                                                            // Tentukan icon berdasarkan ekstensi
                                                            if ($ext == 'pdf') {
                                                                $icon = 'mdi-file-pdf-box text-danger';
                                                                $badge = 'PDF';
                                                                $color = 'danger';
                                                            } elseif (in_array($ext, ['doc', 'docx'])) {
                                                                $icon = 'mdi-file-word-box text-primary';
                                                                $badge = 'DOC';
                                                                $color = 'primary';
                                                            } elseif (in_array($ext, ['xls', 'xlsx'])) {
                                                                $icon = 'mdi-file-excel-box text-success';
                                                                $badge = 'EXCEL';
                                                                $color = 'success';
                                                            } elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                                                                $icon = 'mdi-file-image-box text-warning';
                                                                $badge = 'GAMBAR';
                                                                $color = 'warning';
                                                            } else {
                                                                $icon = 'mdi-file-document-box text-secondary';
                                                                $badge = 'FILE';
                                                                $color = 'secondary';
                                                            }

                                                            // Ambil nama file pendek
                                                            $fileName = basename($file->file_url);
                                                            if (strlen($fileName) > 20) {
                                                                $fileName = substr($fileName, 0, 17) . '...';
                                                            }
                                                        @endphp

                                                        {{-- Tampilkan icon --}}
                                                        <div class="mr-2">
                                                            <i class="mdi {{ $icon }}" style="font-size: 24px;"></i>
                                                        </div>

                                                        {{-- Tampilkan info file --}}
                                                        <div>
                                                            <div class="mb-1">
                                                                <span class="badge badge-{{ $color }}">{{ $badge }}</span>
                                                            </div>
                                                            <div class="text-muted small">
                                                                {{ $fileName }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="text-center">
                                                        <i class="mdi mdi-file-remove text-muted" style="font-size: 20px;"></i>
                                                        <div class="mt-1">
                                                            <small class="text-muted">No file</small>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if($dokumen->status == 'publik')
                                                    <span class="badge badge-success">Publik</span>
                                                @elseif($dokumen->status == 'draft')
                                                    <span class="badge badge-warning">Draft</span>
                                                @else
                                                    <span class="badge badge-secondary">Arsip</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('dokumen-hukum.show', $dokumen->dokumen_id) }}"
                                                        class="btn btn-info btn-sm mr-1" title="Lihat">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('dokumen-hukum.edit', $dokumen->dokumen_id) }}"
                                                        class="btn btn-warning btn-sm mr-1" title="Edit">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('dokumen-hukum.destroy', $dokumen->dokumen_id) }}"
                                                        method="POST" onsubmit="return confirm('Hapus dokumen?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-4">
                                                <i class="mdi mdi-file-document-outline mdi-48px text-muted"></i>
                                                <h5 class="mt-3">Belum ada dokumen</h5>
                                                <a href="{{ route('dokumen-hukum.create') }}" class="btn btn-primary mt-2">
                                                    <i class="mdi mdi-plus"></i> Tambah Dokumen
                                                </a>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($dokumenHukum->hasPages())
                            <div class="mt-3">
                                {{ $dokumenHukum->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .badge-success {
            background: #28a745;
        }

        .badge-warning {
            background: #ffc107;
            color: #000;
        }

        .badge-secondary {
            background: #6c757d;
        }

        .mdi {
            vertical-align: middle;
        }
    </style>
@endsection