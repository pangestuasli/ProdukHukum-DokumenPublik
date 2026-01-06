@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="content-wrapper">
    <!-- Page header -->
    <div class="row">
        <div class="col-md-12">
            <div class="page-header-toolbar mb-3">
                <h1 class="page-title">Produk Hukum - Dokumen Publik</h1>
                <div class="text-muted">
                    <i class="mdi mdi-calendar-check"></i>
                    {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row">
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $totalDokumen }}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success">
                                <i class="mdi mdi-file-document-multiple"></i>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Dokumen Hukum</h6>
                </div>
                <div class="card-footer">
                    <a href="{{ route('dokumen-hukum.index') }}" class="small">
                        Lihat Detail <i class="mdi mdi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $totalWarga }}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-primary">
                                <i class="mdi mdi-account-multiple"></i>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Data Warga</h6>
                </div>
                <div class="card-footer">
                    <a href="{{ route('warga.index') }}" class="small">
                        Kelola Warga <i class="mdi mdi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $totalLampiran }}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-warning">
                                <i class="mdi mdi-paperclip"></i>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Lampiran</h6>
                </div>
                <div class="card-footer">
                    <a href="{{ route('lampiran-dokumen.index') }}" class="small">
                        Lihat Lampiran <i class="mdi mdi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{ $totalUser }}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-danger">
                                <i class="mdi mdi-account-settings"></i>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total User</h6>
                </div>
                <div class="card-footer">
                    @if(auth()->user() && auth()->user()->role == 'admin')
                    <a href="{{ route('user.index') }}" class="small">
                        Kelola User <i class="mdi mdi-arrow-right"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Chart Dokumen per Bulan -->
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Statistik Dokumen Per Bulan ({{ $chartData['year'] }})</h4>
                    <div class="chart-container" style="position: relative; height: 300px;">
                        <canvas id="chartDokumenPerbulan"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Status Dokumen -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Status Dokumen</h4>
                    <div class="row">
                        @foreach($dokumenPerStatus as $status)
                        <div class="col-12 mb-3">
                            <div class="d-flex align-items-center">
                                @php
                                    $color = match($status->status) {
                                        'publik' => 'success',
                                        'draft' => 'warning',
                                        default => 'secondary'
                                    };
                                    $icon = match($status->status) {
                                        'publik' => 'mdi-earth',
                                        'draft' => 'mdi-file-document-edit',
                                        default => 'mdi-archive'
                                    };
                                @endphp
                                <span class="me-3">
                                    <span class="badge badge-{{ $color }} p-2">
                                        <i class="mdi {{ $icon }}"></i>
                                    </span>
                                </span>
                                <div class="flex-grow-1">
                                    <div class="fw-bold">{{ ucfirst($status->status) }}</div>
                                    <div class="progress mt-1">
                                        @php
                                            $percentage = $totalDokumen > 0 ? round(($status->total / $totalDokumen) * 100) : 0;
                                        @endphp
                                        <div class="progress-bar bg-{{ $color }}" 
                                             role="progressbar" 
                                             style="width: {{ $percentage }}%"
                                             aria-valuenow="{{ $percentage }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <strong>{{ $status->total }}</strong>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Dokumen Terbaru -->
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title d-flex justify-content-between align-items-center">
                        <span>Dokumen Terbaru</span>
                        <a href="{{ route('dokumen-hukum.index') }}" class="btn btn-sm btn-primary">
                            Lihat Semua
                        </a>
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dokumenTerbaru as $dokumen)
                                <tr>
                                    <td>
                                        <div class="text-truncate" style="max-width: 150px;">
                                            {{ $dokumen->judul }}
                                        </div>
                                        <small class="text-muted">{{ $dokumen->nomor }}</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">
                                            {{ $dokumen->jenisDokumen->nama_jenis ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $dokumen->status == 'publik' ? 'success' : ($dokumen->status == 'draft' ? 'warning' : 'secondary') }}">
                                            {{ ucfirst($dokumen->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">
                                        <div class="text-muted py-3">
                                            <i class="mdi mdi-file-document-outline mdi-36px"></i>
                                            <p class="mt-2 mb-0">Belum ada dokumen</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Riwayat Terbaru -->
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title d-flex justify-content-between align-items-center">
                        <span>Riwayat Perubahan Terbaru</span>
                        <a href="{{ route('riwayat-perubahan.index') }}" class="btn btn-sm btn-primary">
                            Lihat Semua
                        </a>
                    </h4>
                    <div class="timeline">
                        @forelse($riwayatTerbaru as $riwayat)
                        <div class="timeline-item">
                            <div class="timeline-badge">
                                <i class="mdi mdi-history text-info"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="mb-1">
                                    <strong>{{ $riwayat->dokumenHukum->judul ?? 'Dokumen' }}</strong>
                                </div>
                                <div class="text-muted small mb-1">
                                    {{ Str::limit($riwayat->uraian_perubahan, 60) }}
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="mdi mdi-clock"></i>
                                        {{ $riwayat->created_at->diffForHumans() }}
                                    </small>
                                    <span class="badge badge-info">v{{ $riwayat->versi }}</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4">
                            <i class="mdi mdi-history mdi-36px text-muted"></i>
                            <p class="mt-2 mb-0">Belum ada riwayat perubahan</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Statistik Cepat</h4>
                    <div class="row text-center">
                        <div class="col-md-4 mb-3">
                            <div class="border p-3 rounded">
                                <i class="mdi mdi-file-document-outline text-primary" style="font-size: 40px;"></i>
                                <h3 class="mt-2">{{ $totalJenis }}</h3>
                                <p class="text-muted mb-0">Jenis Dokumen</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="border p-3 rounded">
                                <i class="mdi mdi-folder-outline text-success" style="font-size: 40px;"></i>
                                <h3 class="mt-2">{{ $totalKategori }}</h3>
                                <p class="text-muted mb-0">Kategori Dokumen</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="border p-3 rounded">
                                <i class="mdi mdi-history text-warning" style="font-size: 40px;"></i>
                                <h3 class="mt-2">{{ $riwayatTerbaru->count() }}</h3>
                                <p class="text-muted mb-0">Perubahan Terakhir</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart Dokumen per Bulan
        var ctx = document.getElementById('chartDokumenPerbulan').getContext('2d');
        var chartDokumenPerbulan = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chartData['labels']),
                datasets: [{
                    label: 'Jumlah Dokumen',
                    data: @json($chartData['values']),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Dokumen'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    }
                }
            }
        });

        // Fungsi refresh statistik
        window.refreshStats = function() {
            fetch('{{ route("dashboard.stats") }}')
                .then(response => response.json())
                .then(data => {
                    console.log('Statistik diperbarui:', data);
                    alert('Statistik berhasil diperbarui pada ' + data.updated_at);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memperbarui statistik');
                });
        }
    });
</script>
@endpush

@push('styles')
<style>
    .icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    .icon-box-success {
        background-color: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }
    
    .icon-box-primary {
        background-color: rgba(0, 123, 255, 0.1);
        color: #007bff;
    }
    
    .icon-box-warning {
        background-color: rgba(255, 193, 7, 0.1);
        color: #ffc107;
    }
    
    .icon-box-danger {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
    
    .timeline {
        position: relative;
        padding-left: 30px;
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 20px;
    }
    
    .timeline-badge {
        position: absolute;
        left: -30px;
        top: 0;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        border: 2px solid #dee2e6;
    }
    
    .timeline-content {
        padding: 10px 15px;
        background: #f8f9fa;
        border-radius: 6px;
        border-left: 3px solid #4d83ff;
    }
    
    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .card-footer {
        background: transparent;
        border-top: 1px solid rgba(0,0,0,.125);
        padding: 10px 20px;
    }
    
    .card-footer a {
        color: #4d83ff;
        text-decoration: none;
        font-size: 14px;
    }
    
    .card-footer a:hover {
        text-decoration: underline;
    }
</style>
@endpush
@endsection