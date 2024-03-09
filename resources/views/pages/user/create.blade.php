@extends('layouts.app')

@section('title', 'Tambah User')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href=" {{route('user.index')}} ">User</a></div>
                    <div class="breadcrumb-item">Tambah User</div>
                </div>
            </div>
            <div class="section-body">
{{--                @if(session('error'))--}}
{{--                    <div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
{{--                        {{ $error }}--}}
{{--                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                            <span aria-hidden="true">&times;</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                @endif--}}
                <h2 class="section-title">Tambah User</h2>
                <p class="section-lead">Lengkapi formulir dibawah untuk menambahkan user baru.</p>
                <form action="{{route('user.store')}}" method="post" class="needs-validation" novalidate="">
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Formulir User Baru</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="name" value="{{old('name')}}"
                                               class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" value="{{old('email')}}"
                                               class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </div>
                                            </div>
                                            <input type="password" name="password"
                                                   class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" value="{{old('phone')}}"
                                               class="form-control @error('phone') is-invalid @enderror">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Roles</label>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio"
                                                       name="role"
                                                       value="admin"
                                                       class="selectgroup-input"
                                                       checked="">
                                                <span class="selectgroup-button">Admin</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio"
                                                       name="role"
                                                       value="dokter"
                                                       class="selectgroup-input">
                                                <span class="selectgroup-button">Dokter</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio"
                                                       name="role"
                                                       value="user"
                                                       class="selectgroup-input">
                                                <span class="selectgroup-button">User</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="buttons float-right">
                                            <button  type="submit"
                                               class="btn btn-lg btn-primary">Simpan</button>
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
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
