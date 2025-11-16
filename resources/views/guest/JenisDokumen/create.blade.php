@extends('layouts.guest.app')

@section('title', 'Tambah Jenis Dokumen')

@section('content')
<section id="about" class="hero-section-wrapper-2">
    @include('layouts.guest.header')

    <div class="container pt-100 pb-100">
        <div class="row mb-40">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Tambah Jenis Dokumen</h3>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form-wrapper">
                    <form action="{{ route('jenis-dokumen.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="single-input">
                                    <label for="nama_jenis">Nama Jenis Dokumen <span class="text-danger">*</span></label>
                                    <input type="text" id="nama_jenis" name="nama_jenis" class="form-input @error('nama_jenis') is-invalid @enderror" 
                                           placeholder="Masukkan Nama Jenis Dokumen" value="{{ old('nama_jenis') }}">
                                    <i class="lni lni-text-format"></i>
                                    @error('nama_jenis')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single-input">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" class="form-input @error('deskripsi') is-invalid @enderror" 
                                              placeholder="Masukkan Deskripsi (Opsional)" rows="6">{{ old('deskripsi') }}</textarea>
                                    <i class="lni lni-comments-alt"></i>
                                    @error('deskripsi')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-button">
                                    <button type="submit" class="button radius-10">Simpan <i class="lni lni-checkmark"></i></button>
                                    <a href="{{ route('jenis-dokumen.index') }}" class="button button-sm radius-30" style="background-color: #6c757d; margin-left: 10px;">
                                        Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

