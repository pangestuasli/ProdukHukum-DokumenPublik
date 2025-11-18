@extends('layouts.guest.app')

@section('title', 'Jenis Dokumen')

@section('content')
<section id="about" class="hero-section-wrapper-2">
    @include('layouts.guest.header')

    <div class="container pt-100 pb-100">
        <div class="row mb-40">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Jenis Dokumen</h3>
                    <p class="wow fadeInUp" data-wow-delay=".4s">Kelola jenis dokumen dengan mudah</p>
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
                <a href="{{ route('jenis-dokumen.create') }}" class="button button-lg radius-10 wow fadeInUp" data-wow-delay=".2s">
                    <i class="lni lni-plus"></i> Tambah Jenis Dokumen
                </a>
            </div>
        </div>

        <div class="row">
            @forelse($jenisDokumen as $item)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                <div class="single-pricing document-type-card wow fadeInUp" data-wow-delay=".2s">
                    <div class="document-type-card__media">
                        @if($item->foto_path)
                            <img src="{{ asset('storage/' . $item->foto_path) }}" alt="Foto {{ $item->nama_jenis }}">
                        @else
                            <div class="document-type-card__placeholder">
                                <i class="lni lni-image"></i>
                                <span>Belum ada foto</span>
                            </div>
                        @endif
                    </div>
                    <div class="content">
                        <h6 class="mb-20">{{ $item->nama_jenis }}</h6>
                        <div class="mb-20">
                            <p class="mb-10">{{ $item->deskripsi ?: 'Tidak ada deskripsi' }}</p>
                        </div>
                        <div style="display: flex; gap: 10px; justify-content: center; flex-wrap: wrap;">
                            <a href="{{ route('jenis-dokumen.edit', $item->id) }}" class="button button-sm radius-30">
                                <i class="lni lni-pencil"></i> Edit
                            </a>
                            <form action="{{ route('jenis-dokumen.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
                    <p class="mb-30">Belum ada jenis dokumen. <a href="{{ route('jenis-dokumen.create') }}">Tambah data pertama</a></p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

<style>
.document-type-card {
    min-height: 360px;
    display: flex;
    flex-direction: column;
    gap: 18px;
    padding: 25px;
}

.document-type-card__media {
    width: 100%;
    height: 180px;
    border-radius: 18px;
    overflow: hidden;
    background: #f1f4fb;
    display: flex;
    align-items: center;
    justify-content: center;
}

.document-type-card__media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.document-type-card__placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    color: #6c789b;
    font-weight: 500;
}

.document-type-card__placeholder i {
    font-size: 30px;
}
</style>

