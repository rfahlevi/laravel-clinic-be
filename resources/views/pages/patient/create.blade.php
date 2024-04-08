@extends('layouts.app')

@section('title', 'Jadwal Praktik')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Pasien</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('patients.index') }}">Pasien</a>
                    </div>
                    <div class="breadcrumb-item">
                        Tambah Pasien
                    </div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Tambah Pasien</h2>
                <p class="section-lead">Lengkapi formulir dibawah untuk menambahkan jadwal praktik baru</p>
                <form action="{{ route('patients.store') }}" class="needs-validation" novalidate="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Formulir Pasien Baru</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        {{-- NIK --}}
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label>NIK</label>
                                                <input class="form-control @error('nik') is-invalid @enderror"
                                                    type="text" name="nik" value="{{ old('nik') }}"\>
                                                @error('nik')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- No KK --}}
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label>Nomor Kartu Keluarga</label>
                                                <input class="form-control @error('no_kk') is-invalid @enderror"
                                                    type="text" name="no_kk" value="{{ old('no_kk') }}"\>
                                                @error('no_kk')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label>Nama Pasien</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                                            name="name" value="{{ old('name') }}"\>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        {{-- EMAIL --}}
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control @error('email') is-invalid @enderror"
                                                    type="text" name="email" value="{{ old('email') }}"\>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Phone --}}
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label>No Telepon</label>
                                                <input class="form-control @error('phone') is-invalid @enderror"
                                                    type="text" name="phone" value="{{ old('phone') }}"\>
                                                @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Gender --}}
                                    <div class="form-group mb-4">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="gender" value="Pria"
                                                    class="selectgroup-input" checked="">
                                                <span class="selectgroup-button">Pria</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="gender" value="Wanita"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Wanita</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        {{-- Tempat Lahir --}}
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label>Tempat Lahir</label>
                                                <input class="form-control @error('birth_place') is-invalid @enderror"
                                                    type="text" name="birth_place" value="{{ old('birth_place') }}" \>
                                                @error('birth_place')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Tanggal Lahir --}}
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Lahir</label>
                                                <input class="form-control @error('birth_date') is-invalid @enderror"
                                                    type="date" name="birth_date" value="{{ old('birth_date') }}" \>
                                                @error('birth_date')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label>Alamat Lengkap</label>
                                        <textarea class="form-control @error('address_line') is-invalid @enderror" data-height="100" name="address_line"
                                            data-val="{{ old('address_line') }}"></textarea>
                                        @error('address_line')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        {{-- RT --}}
                                        <div class="col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label>RT</label>
                                                <input class="form-control @error('rt') is-invalid @enderror" type="text"
                                                    name="rt" value="{{ old('rt') }}"\>
                                                @error('rt')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- RW --}}
                                        <div class="col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label>RW</label>
                                                <input class="form-control @error('rw') is-invalid @enderror"
                                                    type="text" name="rw" value="{{ old('rw') }}"\>
                                                @error('rw')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Kelurahan --}}
                                        <div class="col-sm-12 col-md-4">
                                            <div class="form-group">
                                                <label>Kelurahan</label>
                                                <input class="form-control @error('village') is-invalid @enderror"
                                                    type="text" name="village" value="{{ old('village') }}"\>
                                                @error('village')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Kecamatan --}}
                                        <div class="col-sm-12 col-md-4 mb-md-0">
                                            <div class="form-group">
                                                <label>Kecamatan</label>
                                                <input class="form-control @error('district') is-invalid @enderror"
                                                    type="text" name="district" value="{{ old('district') }}" \>
                                                @error('district')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        {{-- Kota --}}
                                        <div class="col-sm-12 col-md-5">
                                            <div class="form-group">
                                                <label>Kota</label>
                                                <input class="form-control @error('city') is-invalid @enderror"
                                                    type="text" name="city" value="{{ old('city') }}"\>
                                                @error('city')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Provinsi --}}
                                        <div class="col-sm-12 col-md-5">
                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <input class="form-control @error('province') is-invalid @enderror"
                                                    type="text" name="province" value="{{ old('province') }}" \>
                                                @error('province')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Kode POS --}}
                                        <div class="col-sm-12 col-md-2">
                                            <div class="form-group">
                                                <label>Kode POS</label>
                                                <input class="form-control @error('postal_code') is-invalid @enderror"
                                                    type="text" name="postal_code" value="{{ old('postal_code') }}"
                                                    \>
                                                @error('postal_code')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Status Perkawain --}}
                                    <div class="form-group mb-4">
                                        <label class="form-label">Status Perkawinan</label>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="marital_status" value="Belum Menikah"
                                                    class="selectgroup-input" checked="">
                                                <span class="selectgroup-button">Belum Menikah</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="marital_status" value="Menikah"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Menikah</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="marital_status" value="Cerai"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Cerai</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="buttons float-right">
                                            <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
