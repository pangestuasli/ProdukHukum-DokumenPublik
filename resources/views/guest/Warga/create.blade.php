@extends('layouts.guest.app')

@section('title', 'Tambah Data Warga')

@section('content')
<section id="home" class="hero-section-wrapper-2">
    @include('layouts.guest.header')

    <div class="container pt-100 pb-100">
        <div class="row mb-40">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Tambah Data Warga</h3>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form-wrapper">
                    <form action="{{ route('warga.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="single-input">
                                    <label for="no_ktp">No. KTP <span class="text-danger">*</span></label>
                                    <input type="text" id="no_ktp" name="no_ktp" class="form-input @error('no_ktp') is-invalid @enderror" 
                                           placeholder="Masukkan No. KTP (16 digit)" value="{{ old('no_ktp') }}" maxlength="16">
                                    <i class="lni lni-id-card"></i>
                                    @error('no_ktp')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="single-input">
                                    <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-input @error('jenis_kelamin') is-invalid @enderror">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    <i class="lni lni-user"></i>
                                    @error('jenis_kelamin')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="single-input">
                                    <label for="agama">Agama <span class="text-danger">*</span></label>
                                    <input type="text" id="agama" name="agama" class="form-input @error('agama') is-invalid @enderror" 
                                           placeholder="Masukkan Agama" value="{{ old('agama') }}">
                                    <i class="lni lni-heart"></i>
                                    @error('agama')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="single-input">
                                    <label for="pekerjaan">Pekerjaan <span class="text-danger">*</span></label>
                                    <input type="text" id="pekerjaan" name="pekerjaan" class="form-input @error('pekerjaan') is-invalid @enderror" 
                                           placeholder="Masukkan Pekerjaan" value="{{ old('pekerjaan') }}">
                                    <i class="lni lni-briefcase"></i>
                                    @error('pekerjaan')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="single-input">
                                    <label for="telepon">Telepon <span class="text-danger">*</span></label>
                                    <input type="text" id="telepon" name="telepon" class="form-input @error('telepon') is-invalid @enderror" 
                                           placeholder="Masukkan No. Telepon" value="{{ old('telepon') }}" maxlength="15">
                                    <i class="lni lni-phone"></i>
                                    @error('telepon')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="single-input">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" id="email" name="email" class="form-input @error('email') is-invalid @enderror" 
                                           placeholder="Masukkan Email" value="{{ old('email') }}">
                                    <i class="lni lni-envelope"></i>
                                    @error('email')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-button">
                                    <button type="submit" class="button radius-10">Simpan <i class="lni lni-checkmark"></i></button>
                                    <a href="{{ route('warga.index') }}" class="button button-sm radius-30" style="background-color: #6c757d; margin-left: 10px;">
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

