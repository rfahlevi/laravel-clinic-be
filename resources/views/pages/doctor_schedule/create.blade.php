@extends('layouts.app')

@section('title', 'Jadwal Praktik')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Jadwal Praktik</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href=" {{ route('schedules.index') }} ">Jadwal Praktik</a></div>
                    <div class="breadcrumb-item">Tambah Jadwal Praktik</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Tambah Jadwal Praktik</h2>
                <p class="section-lead">Lengkapi formulir dibawah untuk menambahkan jadwal praktik baru.</p>
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fadeIn show" role="alert">
                        @foreach ($errors->all() as $error)
                            <p>- {{ $error }}</p>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form action="{{ route('schedules.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Formulir Jadwal Praktik Baru</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Pilih Dokter</label>
                                        <select name="doctor_id" id="doctor_id"
                                            class="form-control select2 @error('doctor_id') is-invalid @enderror"
                                            data-placeholder="Pilih Dokter">
                                            <option value=""></option>
                                            @foreach ($doctors as $doctor)
                                                <option value="{{ $doctor->id }}"
                                                    @if (old('doctor_id') == $doctor->id) selected @endIf>{{ $doctor->name }},
                                                    {{ $doctor->specialization }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tentukan Jadwal</label>
                                        <div
                                            class="d-md-flex flex-row d-sm-block justify-content-between align-items-center mb-2 border-bottom">
                                            <p class="text-dark font-weight-600 mt-1">Senin</p>
                                            <div class="d-flex align-items-center mb-1">
                                                <input type="time"
                                                    class="form-control form-control-sm @error('senin_start') is-invalid @enderror"
                                                    style="width: 100px" name="senin_start"
                                                    value="{{ old('senin_start') }}">
                                                <div class="mx-2 pt-3">
                                                    <p>sampai</p>
                                                </div>
                                                <input type="time"
                                                    class="form-control form-control-sm @error('senin_end') is-invalid @enderror"
                                                    style="width: 100px" name="senin_end" value="{{ old('senin_end') }}">
                                            </div>
                                        </div>

                                        <div
                                            class="d-md-flex flex-row d-sm-block justify-content-between align-items-center mb-2 border-bottom">
                                            <p class="text-dark font-weight-600 mt-1">Selasa</p>
                                            <div class="d-flex align-items-center mb-1">
                                                <input type="time"
                                                    class="form-control form-control-sm @error('selasa_start') is-invalid @enderror"
                                                    style="width: 100px" name="selasa_start"
                                                    value="{{ old('selasa_start') }}">
                                                <div class="mx-2 pt-3">
                                                    <p>sampai</p>
                                                </div>
                                                <input type="time"
                                                    class="form-control form-control-sm @error('selasa_end') is-invalid @enderror"
                                                    style="width: 100px" name="selasa_end" value="{{ old('selasa_end') }}">
                                            </div>
                                        </div>
                                        <div
                                            class="d-md-flex flex-row d-sm-block justify-content-between align-items-center mb-2 border-bottom">
                                            <p class="text-dark font-weight-600 mt-1">Rabu</p>
                                            <div class="d-flex align-items-center mb-1">
                                                <input type="time"
                                                    class="form-control form-control-sm @error('rabu_start') is-invalid @enderror"
                                                    style="width: 100px" name="rabu_start" value="{{ old('rabu_start') }}">
                                                <div class="mx-2 pt-3">
                                                    <p>sampai</p>
                                                </div>
                                                <input type="time"
                                                    class="form-control form-control-sm @error('rabu_end') is-invalid @enderror"
                                                    style="width: 100px" name="rabu_end" value="{{ old('rabu_end') }}">
                                            </div>
                                        </div>
                                        <div
                                            class="d-md-flex flex-row d-sm-block justify-content-between align-items-center mb-2 border-bottom">
                                            <p class="text-dark font-weight-600 mt-1">Kamis</p>
                                            <div class="d-flex align-items-center mb-1">
                                                <input type="time"
                                                    class="form-control form-control-sm @error('kamis_start') is-invalid @enderror"
                                                    style="width: 100px" name="kamis_start"
                                                    value="{{ old('kamis_start') }}">
                                                <div class="mx-2 pt-3">
                                                    <p>sampai</p>
                                                </div>
                                                <input type="time"
                                                    class="form-control form-control-sm @error('kamis_end') is-invalid @enderror"
                                                    style="width: 100px" name="kamis_end" value="{{ old('kamis_end') }}">
                                            </div>
                                        </div>
                                        <div
                                            class="d-md-flex flex-row d-sm-block justify-content-between align-items-center mb-2 border-bottom">
                                            <p class="text-dark font-weight-600 mt-1">Jum'at</p>
                                            <div class="d-flex align-items-center mb-1">
                                                <input type="time"
                                                    class="form-control form-control-sm @error('jumat_start') is-invalid @enderror"
                                                    style="width: 100px" name="jumat_start"
                                                    value="{{ old('jumat_start') }}">
                                                <div class="mx-2 pt-3">
                                                    <p>sampai</p>
                                                </div>
                                                <input type="time"
                                                    class="form-control form-control-sm @error('jumat_end') is-invalid @enderror"
                                                    style="width: 100px" name="jumat_end"
                                                    value="{{ old('jumat_end') }}">
                                            </div>
                                        </div>
                                        <div
                                            class="d-md-flex flex-row d-sm-block justify-content-between align-items-center mb-2 border-bottom">
                                            <p class="text-dark font-weight-600 mt-1">Sabtu</p>
                                            <div class="d-flex align-items-center mb-1">
                                                <input type="time"
                                                    class="form-control form-control-sm @error('sabtu_start') is-invalid @enderror"
                                                    style="width: 100px" name="sabtu_start"
                                                    value="{{ old('sabtu_start') }}">
                                                <div class="mx-2 pt-3">
                                                    <p>sampai</p>
                                                </div>
                                                <input type="time"
                                                    class="form-control form-control-sm @error('sabtu_end') is-invalid @enderror"
                                                    style="width: 100px" name="sabtu_end"
                                                    value="{{ old('sabtu_end') }}">
                                            </div>
                                        </div>
                                        <div
                                            class="d-md-flex flex-row d-sm-block justify-content-between align-items-center mb-2 border-bottom">
                                            <p class="text-dark font-weight-600 mt-1">Minggu</p>
                                            <div class="d-flex align-items-center mb-1">
                                                <input type="time"
                                                    class="form-control form-control-sm @error('minggu_start') is-invalid @enderror"
                                                    style="width: 100px" name="minggu_start"
                                                    value="{{ old('minggu_start') }}">
                                                <div class="mx-2 pt-3">
                                                    <p>sampai</p>
                                                </div>
                                                <input type="time"
                                                    class="form-control form-control-sm @error('minggu_end') is-invalid @enderror"
                                                    style="width: 100px" name="minggu_end"
                                                    value="{{ old('minggu_end') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Catatan</label>
                                        <textarea class="form-control @error('note') is-invalid @enderror" data-height="100" name="note"
                                            data-val="{{ old('note') }}"></textarea>
                                        @error('note')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="status" value="Aktif"
                                                    class="selectgroup-input" checked="checked">
                                                <span class="selectgroup-button">Aktif</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="status" value="Tidak Aktif"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">Tidak Aktif</span>
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

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
@endpush
