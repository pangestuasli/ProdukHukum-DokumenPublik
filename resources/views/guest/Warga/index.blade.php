@extends('layouts.guest.app')

@section('title', 'Data Warga')

@section('content')
<section id="home" class="hero-section-wrapper-2">
    @include('layouts.guest.header')

    <div class="container pt-100 pb-100">
        <div class="row mb-40">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Data Warga</h3>
                    <p class="wow fadeInUp" data-wow-delay=".4s">Kelola data warga dengan mudah</p>
                </div>
            </div>
        </div>

        @if(session('success'))
        <div class="row mb-30">
            <div class="col-lg-12">
                <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            </div>
        </div>
        @endif

        <div class="row mb-30">
            <div class="col-lg-12" style="text-align: right;">
                <a href="{{ route('warga.create') }}" class="button button-lg radius-10 wow fadeInUp" data-wow-delay=".2s">
                    <i class="lni lni-plus"></i> Tambah Data Warga
                </a>
            </div>
        </div>

        <div class="row">
            @forelse($warga as $item)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                <div class="single-pricing wow fadeInUp" data-wow-delay=".2s" style="min-height: 400px;">
                    <div class="content">
                        <h6 class="mb-20">No. KTP: {{ $item->no_ktp }}</h6>
                        <div class="mb-20">
                            <p class="mb-10"><strong><i class="lni lni-user"></i> Jenis Kelamin:</strong> {{ $item->jenis_kelamin }}</p>
                            <p class="mb-10"><strong><i class="lni lni-heart"></i> Agama:</strong> {{ $item->agama }}</p>
                            <p class="mb-10"><strong><i class="lni lni-briefcase"></i> Pekerjaan:</strong> {{ $item->pekerjaan }}</p>
                            <p class="mb-10"><strong><i class="lni lni-phone"></i> Telepon:</strong> {{ $item->telepon }}</p>
                            <p class="mb-10"><strong><i class="lni lni-envelope"></i> Email:</strong> {{ $item->email }}</p>
                        </div>
                        <div style="display: flex; gap: 10px; justify-content: center; flex-wrap: wrap;">
                            <a href="{{ route('warga.edit', $item->id) }}" class="button button-sm radius-30">
                                <i class="lni lni-pencil"></i> Edit
                            </a>
                            <form action="{{ route('warga.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button-sm radius-30" style="background-color: #dc3545;">
                                    <i class="lni lni-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-lg-12">
                <div class="text-center">
                    <p class="mb-30">Belum ada data warga. <a href="{{ route('warga.create') }}">Tambah data pertama</a></p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

