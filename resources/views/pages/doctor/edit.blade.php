@extends('layouts.app')

@section('title', 'Edit Dokter')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Dokter</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href=" {{ route('doctors.index') }} ">Dokter</a></div>
                    <div class="breadcrumb-item">Edit Dokter</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Edit Dokter</h2>
                <p class="section-lead">Lengkapi formulir dibawah untuk mengupdate dokter baru.</p>
                <form action="{{ route('doctors.update', $doctor) }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate="">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Formulir Dokter Baru</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="inputGroupFile03">Pilih file</label>
                                                <input type="file" name="photo" value="{{ $doctor->photo }}"
                                                    class="custom-file-input @error('photo') is-invalid @enderror"
                                                    id="inputGroupFile03" aria-describedby="inputGroupFileAddon03">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>SIP</label>
                                        <input type="text" name="sip" value="{{ $doctor->sip }}"
                                            class="form-control @error('sip') is-invalid @enderror">
                                        @error('sip')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>ID IHS</label>
                                        <input type="text" name="id_ihs" value="{{ $doctor->id_ihs }}"
                                            class="form-control @error('id_ihs') is-invalid @enderror">
                                        @error('id_ihs')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>NIK</label>
                                        <input type="text" name="nik" value="{{ $doctor->nik }}"
                                            class="form-control @error('nik') is-invalid @enderror">
                                        @error('nik')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="name" value="{{ $doctor->name }}"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Spesialisasi</label>
                                        <input type="text" name="specialization" value="{{ $doctor->specialization }}"
                                            class="form-control @error('specialization') is-invalid @enderror">
                                        @error('specialization')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>No Telepon</label>
                                        <div class="input-group">
                                            <input type="text" name="phone" value="{{ $doctor->phone }}"
                                                class="form-control @error('phone') is-invalid @enderror">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="input-group">
                                            <input type="text" name="email" value="{{ $doctor->email }}"
                                                class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Alamat</label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" data-height="100" name="address">
                                            {{ $doctor->address }}
                                        </textarea>
                                        @error('address')
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

@push('scripts')
    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
