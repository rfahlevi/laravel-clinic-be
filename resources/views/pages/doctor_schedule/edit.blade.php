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
                <h1>Edit Jadwal Praktik</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href=" {{ route('schedules.index') }} ">Jadwal Praktik</a></div>
                    <div class="breadcrumb-item">Edit Jadwal Praktik</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Edit Jadwal Praktik</h2>
                <p class="section-lead">Lengkapi formulir dibawah untuk mengupdate jadwal praktik.</p>
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
                <form action="{{ route('schedules.update', $schedule->id) }}" method="POST" class="needs-validation"
                    novalidate>
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Formulir Edit Jadwal Praktik</h4>
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
                                                    @if ($schedule->doctor_id == $doctor->id) selected @endif>{{ $doctor->name }},
                                                    {{ $doctor->specialization }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jadwal Berlaku</label>
                                        <div
                                            class="d-md-flex flex-row d-sm-block justify-content-between align-items-center">
                                            <p class="text-dark font-weight-600 mt-1">{{ $schedule->day }}</p>
                                            <div class="d-flex align-items-center mb-1">
                                                <input type="time"
                                                    class="form-control form-control-sm @error('start') is-invalid @enderror"
                                                    style="width: 100px" name="start" value="{{ $schedule->start }}">
                                                <div class="mx-2 pt-3">
                                                    <p>sampai</p>
                                                </div>
                                                <input type="time"
                                                    class="form-control form-control-sm @error('end') is-invalid @enderror"
                                                    style="width: 100px" name="end" value="{{ $schedule->end }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Catatan</label>
                                        <textarea class="form-control @error('note') is-invalid @enderror" data-height="100" name="note">{{ $schedule->note }}</textarea>
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
                                                    class="selectgroup-input"
                                                    @if ($schedule->status == 'Aktif') checked @endif>
                                                <span class="selectgroup-button">Aktif</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="status" value="Tidak Aktif"
                                                    class="selectgroup-input"
                                                    @if ($schedule->status == 'Tidak Aktif') checked @endif>
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
