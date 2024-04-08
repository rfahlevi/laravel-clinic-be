@extends('layouts.app')

@section('title', 'Pasien')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pasien</h1>
            </div>
            <div class="section-body">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <h2 class="section-title">Pasien</h2>
                <p class="section-lead">Anda bisa mengelola semua data pasien, seperti mengubah, menghapus dan yang
                    lainnya.</p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="section-header-button pl-4 pt-4">
                                <a href="{{ route('patients.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    Tambah Pasien
                                </a>
                            </div>
                            <div class="card-header">
                                <h4>Data Pasien</h4>
                                <div class="card-header-form">
                                    <form>
                                        <div class="input-group d-flex align-items-center">
                                            <input type="text" name="patient" class="form-control"
                                                placeholder="Cari NIK / Nama Pasien" value="{{ Request::get('patient') }}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-icon btn-primary">
                                                    <i class="fas fa-magnifying-glass"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (count($patients) == 0)
                                    <div class="w-full d-flex p-0 justify-content-center align-items-center"
                                        style="height: 100px">
                                        <h5>Oopss, Data Pasien Kosong...</h5>
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm table-hover table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th class="align-middle">#</th>
                                                    <th class="align-middle">NIK</th>
                                                    <th class="align-middle">No. KK</th>
                                                    <th class="align-middle">Nama Pasien</th>
                                                    <th class="align-middle">Jenis Kelamin</th>
                                                    <th class="align-middle"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($patients as $patient)
                                                    <tr>
                                                        <td class="text-center align-middle">
                                                            {{ $patients->firstItem() + $loop->index }}</td>
                                                        <td class="align-middle text-center">
                                                            {{ $patient->nik }}
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            {{ $patient->no_kk }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ $patient->name }},
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            {{ $patient->gender }}
                                                        </td>
                                                        <td class="align-middle justify-content-center d-flex">
                                                            <a href="{{ route('patients.show', $patient->id) }}"
                                                                class="btn btn-sm btn-outline-dark mr-2">
                                                                Detail
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                {{ $patients->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
