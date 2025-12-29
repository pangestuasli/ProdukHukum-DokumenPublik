@extends('layouts.app')

@section('title', 'Lampiran Dokumen Hukum')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Lampiran Dokumen Hukum</h4>
                <div class="d-flex justify-content-between mb-3">
                    <a href="{{ route('lampiran-dokumen.create') }}" class="btn btn-primary">
                        <i class="ti-plus"></i> Tambah Lampiran
                    </a>
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filter Dokumen
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('lampiran-dokumen.index') }}">Semua</a>
                            @foreach($dokumenList as $dokumen)
                            <a class="dropdown-item" href="?dokumen_id={{ $dokumen->dokumen_id }}">
                                {{ $dokumen->judul ?? 'Dokumen Hukum #' . $dokumen->dokumen_id }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Dokumen Hukum</th>
                                <th>Nomor Dokumen</th>
                                <th>File Lampiran</th>
                                <th>Keterangan</th>
                                <th>Tanggal Upload</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lampiran as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($item->dokumenHukum)
                                        <strong>{{ $item->dokumenHukum->judul }}</strong>
                                    @else
                                        <span class="text-danger">Dokumen tidak ditemukan</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->dokumenHukum)
                                        {{ $item->dokumenHukum->nomor ?? '-' }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @php
                                            $icon = match($item->tipe_file) {
                                                'pdf' => 'ti-file',
                                                'jpg', 'jpeg', 'png', 'gif' => 'ti-image',
                                                'doc', 'docx' => 'ti-file',
                                                'xls', 'xlsx' => 'ti-layout-grid2',
                                                default => 'ti-file'
                                            };
                                        @endphp
                                        <i class="ti {{ $icon }} mr-2"></i>
                                        <span class="text-truncate" style="max-width: 150px;">
                                            {{ $item->berkas_lampiran }}
                                        </span>
                                    </div>
                                </td>
                                <td>{{ Str::limit($item->keterangan, 50) }}</td>
                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('lampiran-dokumen.show', $item->lampiran_id) }}" 
                                           class="btn btn-info btn-sm" title="Lihat">
                                            <i class="ti-eye"></i>
                                        </a>
                                        <a href="{{ route('lampiran-dokumen.edit', $item->lampiran_id) }}" 
                                           class="btn btn-warning btn-sm" title="Edit">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <form action="{{ route('lampiran-dokumen.destroy', $item->lampiran_id) }}" 
                                              method="POST" class="d-inline" 
                                              onsubmit="return confirm('Hapus lampiran ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    {{ $lampiran->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.text-truncate {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.btn-group .btn-sm {
    padding: 0.25rem 0.5rem;
    margin: 0 2px;
}
</style>
@endpush