{{-- Partial form fields untuk Warga (digunakan di create & edit) --}}

{{-- No KTP --}}
<div class="mb-3">
    <label for="no_ktp" class="form-label">No KTP</label>
    <input type="text" id="no_ktp" name="no_ktp"
           value="{{ old('no_ktp', $warga->no_ktp ?? '') }}"
           class="form-control @error('no_ktp') is-invalid @enderror" required>
    @error('no_ktp')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Nama --}}
<div class="mb-3">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" id="nama" name="nama"
           value="{{ old('nama', $warga->nama ?? '') }}"
           class="form-control @error('nama') is-invalid @enderror" required>
    @error('nama')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Jenis Kelamin --}}
<div class="mb-3">
    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
    <select id="jenis_kelamin" name="jenis_kelamin"
            class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
        <option value="">-- Pilih --</option>
        <option value="Laki-laki" {{ old('jenis_kelamin', $warga->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
        <option value="Perempuan" {{ old('jenis_kelamin', $warga->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
    </select>
    @error('jenis_kelamin')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Agama --}}
<div class="mb-3">
    <label for="agama" class="form-label">Agama</label>
    <input type="text" id="agama" name="agama"
           value="{{ old('agama', $warga->agama ?? '') }}"
           class="form-control @error('agama') is-invalid @enderror" required>
    @error('agama')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Pekerjaan --}}
<div class="mb-3">
    <label for="pekerjaan" class="form-label">Pekerjaan</label>
    <input type="text" id="pekerjaan" name="pekerjaan"
           value="{{ old('pekerjaan', $warga->pekerjaan ?? '') }}"
           class="form-control @error('pekerjaan') is-invalid @enderror">
    @error('pekerjaan')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Telepon --}}
<div class="mb-3">
    <label for="telp" class="form-label">Telepon</label>
    <input type="text" id="telp" name="telp"
           value="{{ old('telp', $warga->telp ?? '') }}"
           class="form-control @error('telp') is-invalid @enderror">
    @error('telp')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Email --}}
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" id="email" name="email"
           value="{{ old('email', $warga->email ?? '') }}"
           class="form-control @error('email') is-invalid @enderror">
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
