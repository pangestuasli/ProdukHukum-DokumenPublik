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
            <div class="col-lg-8 col-xl-7">
                <div class="contact-form-wrapper document-form-card">
                    <div class="document-form-card__header">
                        <p class="mb-0">Masukkan informasi warga dengan lengkap dan valid. Data yang bertanda <span class="text-danger">*</span> wajib diisi untuk memastikan akurasi.</p>
                    </div>
                    <form action="{{ route('warga.store') }}" method="POST" class="document-form-card__body">
                        @csrf
                        <div class="single-input">
                            <label for="no_ktp">No. KTP <span class="text-danger">*</span></label>
                            <div class="input-with-icon">
                                <i class="lni lni-id-card"></i>
                                <input type="text" id="no_ktp" name="no_ktp" class="form-input @error('no_ktp') is-invalid @enderror" 
                                       placeholder="Masukkan No. KTP (16 digit)" value="{{ old('no_ktp') }}" maxlength="16">
                            </div>
                            @error('no_ktp')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-grid">
                            <div class="single-input">
                                <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                <div class="input-with-icon select">
                                    <i class="lni lni-user"></i>
                                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-input @error('jenis_kelamin') is-invalid @enderror">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="single-input">
                                <label for="agama">Agama <span class="text-danger">*</span></label>
                                <div class="input-with-icon">
                                    <i class="lni lni-heart"></i>
                                    <input type="text" id="agama" name="agama" class="form-input @error('agama') is-invalid @enderror" 
                                           placeholder="Masukkan Agama" value="{{ old('agama') }}">
                                </div>
                                @error('agama')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="single-input">
                                <label for="pekerjaan">Pekerjaan <span class="text-danger">*</span></label>
                                <div class="input-with-icon">
                                    <i class="lni lni-briefcase"></i>
                                    <input type="text" id="pekerjaan" name="pekerjaan" class="form-input @error('pekerjaan') is-invalid @enderror" 
                                           placeholder="Masukkan Pekerjaan" value="{{ old('pekerjaan') }}">
                                </div>
                                @error('pekerjaan')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="single-input">
                                <label for="telepon">Telepon <span class="text-danger">*</span></label>
                                <div class="input-with-icon">
                                    <i class="lni lni-phone"></i>
                                    <input type="text" id="telepon" name="telepon" class="form-input @error('telepon') is-invalid @enderror" 
                                           placeholder="Masukkan No. Telepon" value="{{ old('telepon') }}" maxlength="15">
                                </div>
                                @error('telepon')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="single-input">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <div class="input-with-icon">
                                <i class="lni lni-envelope"></i>
                                <input type="email" id="email" name="email" class="form-input @error('email') is-invalid @enderror" 
                                       placeholder="Masukkan Email" value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-button document-form-card__actions">
                            <button type="submit" class="button radius-10 primary-action">
                                <i class="lni lni-checkmark"></i> Simpan
                            </button>
                            <a href="{{ route('warga.index') }}" class="button radius-10 secondary-action">
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

<style>
.document-form-card {
    background-color: #fff;
    border-radius: 28px;
    padding: 40px 48px;
    box-shadow: 0 25px 60px rgba(15, 23, 42, 0.08);
}

.document-form-card__header {
    background: linear-gradient(120deg, rgba(83, 123, 255, 0.12), rgba(0, 210, 190, 0.12));
    border-radius: 18px;
    padding: 18px 22px;
    margin-bottom: 28px;
    font-size: 15px;
    color: #4f566b;
}

.document-form-card label {
    font-weight: 600;
    color: #1f2a37;
    margin-bottom: 10px;
    display: inline-block;
}

.document-form-card .input-with-icon {
    position: relative;
    display: flex;
    align-items: center;
    background: #f7f9fc;
    border-radius: 16px;
    padding: 0 18px;
    border: 1px solid transparent;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.document-form-card .input-with-icon select,
.document-form-card .input-with-icon input {
    border: none;
    background: transparent;
    box-shadow: none;
    padding-left: 12px;
    width: 100%;
    height: 56px;
}

.document-form-card .input-with-icon select:focus,
.document-form-card .input-with-icon input:focus {
    outline: none;
}

.document-form-card .input-with-icon i {
    color: #5f6b84;
    font-size: 20px;
}

.document-form-card .input-with-icon:focus-within {
    border-color: rgba(83, 123, 255, 0.65);
    box-shadow: 0 10px 30px rgba(83, 123, 255, 0.12);
    background: #fff;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 24px;
    margin: 24px 0;
}

.document-form-card__actions {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
    margin-top: 32px;
}

.document-form-card__actions .button {
    border: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 28px;
}

.document-form-card__actions .primary-action {
    background: linear-gradient(120deg, #437ff5, #00d2be);
    color: #fff;
}

.document-form-card__actions .secondary-action {
    background: #e8ecf5;
    color: #1f2a37;
}

.document-form-card__actions .secondary-action:hover {
    background: #dfe5f2;
}

@media (max-width: 767px) {
    .document-form-card {
        padding: 30px 22px;
    }

    .form-grid {
        grid-template-columns: repeat(1, minmax(0, 1fr));
    }

    .document-form-card__actions {
        flex-direction: column;
    }

    .document-form-card__actions .button {
        width: 100%;
        justify-content: center;
    }
}
</style>
