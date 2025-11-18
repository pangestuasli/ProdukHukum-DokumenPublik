@extends('layouts.guest.app')

@section('title', 'Edit Jenis Dokumen')

@section('content')
<section id="about" class="hero-section-wrapper-2">
    @include('layouts.guest.header')

    <div class="container pt-100 pb-100">
        <div class="row mb-40">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Edit Jenis Dokumen</h3>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <div class="contact-form-wrapper document-form-card">
                    <div class="document-form-card__header">
                        <p class="mb-0">Perbarui informasi jenis dokumen berikut termasuk foto pendukung jika diperlukan.</p>
                    </div>
                    <form action="{{ route('jenis-dokumen.update', $jenisDokumen->id) }}" method="POST" class="document-form-card__body" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="single-input">
                            <label for="nama_jenis">Nama Jenis Dokumen <span class="text-danger">*</span></label>
                            <div class="input-with-icon">
                                <i class="lni lni-text-format"></i>
                                <input type="text" id="nama_jenis" name="nama_jenis" class="form-input @error('nama_jenis') is-invalid @enderror" 
                                       placeholder="Masukkan Nama Jenis Dokumen" value="{{ old('nama_jenis', $jenisDokumen->nama_jenis) }}">
                            </div>
                            @error('nama_jenis')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="single-input">
                            <label for="deskripsi">Deskripsi</label>
                            <div class="input-with-icon textarea">
                                <i class="lni lni-comments-alt"></i>
                                <textarea name="deskripsi" id="deskripsi" class="form-input @error('deskripsi') is-invalid @enderror" 
                                          placeholder="Masukkan Deskripsi (Opsional)" rows="6">{{ old('deskripsi', $jenisDokumen->deskripsi) }}</textarea>
                            </div>
                            @error('deskripsi')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="single-input">
                            <label for="foto">Foto Jenis Dokumen</label>
                            <div class="media-upload">
                                @php
                                    $currentFoto = $jenisDokumen->foto_path ? asset('storage/' . $jenisDokumen->foto_path) : '';
                                @endphp
                                <div class="media-preview" id="fotoPreview" data-default-image="{{ $currentFoto }}">
                                    <span class="media-preview__placeholder {{ $currentFoto ? 'd-none' : '' }}">
                                        <i class="lni lni-image"></i>
                                        Belum ada foto
                                    </span>
                                    <img src="{{ $currentFoto }}" alt="Preview foto" class="media-preview__img {{ $currentFoto ? '' : 'd-none' }}">
                                </div>
                                <div class="upload-actions">
                                    <label class="upload-button">
                                        <input type="file" id="foto" name="foto" accept="image/*" hidden>
                                        <i class="lni lni-cloud-upload"></i>
                                        Ganti Foto
                                    </label>
                                    <p class="upload-hint mb-0">Biarkan kosong jika tidak ingin mengubah foto.</p>
                                </div>
                            </div>
                            @error('foto')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-button document-form-card__actions">
                            <button type="submit" class="button radius-10 primary-action">
                                <i class="lni lni-checkmark"></i> Update
                            </button>
                            <a href="{{ route('jenis-dokumen.index') }}" class="button radius-10 secondary-action">
                                <i class="lni lni-close"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@include('guest.JenisDokumen.partials.form-styles')
