@extends('layouts.app')

@section('title', 'Jadwal Praktik')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Update Layanan Klinik</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('clinic-services.index') }}">Layanan Klinik</a>
                    </div>
                    <div class="breadcrumb-item">
                        Update Layanan Klinik
                    </div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Update Layanan Klinik</h2>
                <p class="section-lead">Lengkapi formulir dibawah untuk mengupdate layanan klinik</p>
                <form action="{{ route('clinic-services.update', $service->id) }}" class="needs-validation" novalidate=""
                    method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Formulir Update Layanan Klinik</h4>
                                </div>
                                <div class="card-body">
                                    {{-- Nama Layanan --}}
                                    <div class="form-group">
                                        <label>Nama Layanan</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                                            name="name" value="{{ $service->name }}">
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
                                                    class="selectgroup-input"
                                                    @if ($service->category == 'Obat-Obatan') checked @endif>
                                                <span class="selectgroup-button">Obat-Obatan</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="category" value="Treatment"
                                                    class="selectgroup-input"
                                                    @if ($service->category == 'Treatment') checked @endif>
                                                <span class="selectgroup-button">Treatment</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="category" value="Konsultasi"
                                                    class="selectgroup-input"
                                                    @if ($service->category == 'Konsultasi') checked @endif>
                                                <span class="selectgroup-button">Konsultasi</span>
                                            </label>
                                        </div>
                                    </div>
                                    {{-- Harga Layanan --}}
                                    <div class="form-group">
                                        <label>Harga Layanan</label>
                                        <input class="form-control @error('price') is-invalid @enderror" type="text"
                                            name="price" value="{{ $service->price }}">
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
                                            name="qty" value="{{ $service->qty }}">
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
