@extends('layouts.app')

@section('title', 'Pasien')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Pasien</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href=" {{ route('patients.index') }} ">Pasien</a></div>
                    <div class="breadcrumb-item">Detail Pasien</div>
                </div>
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            {{-- Identitas --}}
                            <div class="card-body">
                                <h6 class="py-2 pl-2 rounded rounded-2 bg-primary text-white">Identitas</h6>
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <p class="mb-0">Nama Pasien</p>
                                        <h6>{{ $patient->name }}</h6>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <p class="mb-0">Jenis Kelamin</p>
                                        <h6>{{ $patient->gender }}</h6>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <p class="mb-0">Tempat Lahir</p>
                                        <h6>{{ $patient->birth_place }}</h6>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <p class="mb-0">Tanggal Lahir</p>
                                        <h6>{{ \Carbon\Carbon::parse($patient->birth_date)->format('d M Y') }}</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <p class="mb-0">NIK</p>
                                        <h6>{{ $patient->nik }}</h6>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <p class="mb-0">No. KK</p>
                                        <h6>{{ $patient->no_kk }}</h6>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <p class="mb-0">Status Perkawinan</p>
                                        <h6>{{ $patient->marital_status }}</h6>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <p class="mb-0">Is Deceased</p>
                                        <h6>{{ $patient->is_deceased == 0 ? 'Hidup' : 'Meninggal' }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            {{-- Alamat --}}
                            <div class="card-body">
                                <h6 class="py-2 pl-2 rounded rounded-2 bg-primary text-white">Alamat</h6>
                                <p class="mb-0">Alamat Lengkap</p>
                                <h6>{{ $patient->address_line }}</h6>
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <p class="mb-0">RT/RW</p>
                                        <h6>{{ $patient->rt }}/{{ $patient->rw }}</h6>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <p class="mb-0">Kelurahan</p>
                                        <h6>{{ $patient->village }}</h6>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <p class="mb-0">Kecamatan</p>
                                        <h6>{{ $patient->district }}</h6>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <p class="mb-0">Kota</p>
                                        <h6>{{ $patient->city }}</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <p class="mb-0">Provinsi</p>
                                        <h6>{{ $patient->province }}</h6>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <p class="mb-0">Kode POS</p>
                                        <h6>{{ $patient->postal_code }}</h6>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <p class="mb-0">No Telepon</p>
                                        <h6>{{ $patient->phone }}</h6>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <p class="mb-0">Email</p>
                                        <h6>{{ $patient->email ?? '-' }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-footer d-flex">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('patients.edit', $patient->id) }}"
                                        class="btn btn-icon btn-outline-primary mr-2">
                                        <i class="far fa-edit"></i>
                                        <span>Edit</span>
                                    </a>
                                    <a href="" data-toggle="modal" onclick="deletePatient('{{ $patient->id }}')"
                                        class="btn btn-icon btn-outline-danger">
                                        <i class="fas fa-trash-alt"></i>
                                        <span>Hapus</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection

{{-- Confirm Delete Modal --}}
<div class="modal fade" tabindex="-1" role="dialog" id="deletePatientModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Hapus pasien dari database?</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <form action="{{ route('patients.destroy', $schedule->id ?? '') }}" method="post"
                    id="deletePatientForm">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-secondary">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Confirm Delete Modal --}}

{{-- Delete Patient Function --}}
<script>
    function deletePatient(id) {
        $('#deletePatientModal').modal('show');
        $('#deletePatientForm').attr('action', '/patients/' + id)
        $('.delete').on('click', function() {});
    }
</script>
{{-- Delete Patient Function --}}
