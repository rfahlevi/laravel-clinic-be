@extends('layouts.app')

@section('title', 'Jadwal Praktik')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Layanan Klinik</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('clinic-services.index') }}">Layanan Klinik</a>
                    </div>
                    <div class="breadcrumb-item">
                        Tambah Layanan Klinik
                    </div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Tambah Layanan Klinik</h2>
                <p class="section-lead">Lengkapi formulir dibawah untuk menambahkan layanan klinik baru</p>
                <form action="{{ route('clinic-services.store') }}" class="needs-validation" novalidate="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Formulir Layanan Klinik Baru</h4>
                                </div>
                                <div class="card-body">
                                    {{-- Nama Layanan --}}
                                    <div class="form-group">
                                        <label>Nama Layanan</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                                            name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- Kategori --}}
                                    <div class="form-group mb-4">
                                        <label class="form-label">Kategori Layanan</label>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="category" value="Obat-Obatan"
                                                    class="selectgroup-input" checked="">
                                                <span class="selectgroup-button">Obat-Obatan</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="category" value="Treatment"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Treatment</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="category" value="Konsultasi"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Konsultasi</span>
                                            </label>
                                        </div>
                                    </div>
                                    {{-- Harga Layanan --}}
                                    <div class="form-group">
                                        <label>Harga Layanan</label>
                                        <input class="form-control @error('price') is-invalid @enderror" type="text"
                                            name="price" value="{{ old('price') }}">
                                        @error('price')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- Qty Layanan --}}
                                    <div class="form-group">
                                        <label>Qty</label>
                                        <input class="form-control @error('qty') is-invalid @enderror" type="text"
                                            name="qty" value="{{ old('qty') }}">
                                        @error('qty')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
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
