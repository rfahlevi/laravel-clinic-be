@extends('layouts.app')

@section('title', 'Dokter')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dokter</h1>
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
                <h2 class="section-title">Dokter</h2>
                <p class="section-lead">Anda bisa mengelola semua dokter, seperti mengubah, menghapus dan yang lainnya.</p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="section-header-button pl-4 pt-4">
                                <a href="{{ route('doctors.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    Tambah Dokter
                                </a>
                            </div>
                            <div class="card-header">
                                <h4>Data Dokter</h4>
                                <div class="card-header-form">
                                    <form>
                                        <div class="input-group d-flex align-items-center">
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Cari Dokter" value="{{ old('name') }}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-icon btn-primary py-2">
                                                    <i class="fas fa-magnifying-glass"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-bordered table-md table">
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Foto</th>
                                            <th>SIP</th>
                                            <th>ID IHS</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Spesialis</th>
                                            <th>No Telepon</th>
                                            <th></th>
                                        </tr>
                                        @foreach ($doctors as $doctor)
                                            <tr>
                                                <td class="text-center align-middle">
                                                    {{ $doctors->firstItem() + $loop->index }}</td>
                                                <td><img class="rounded"
                                                        src="{{ str_contains($doctor->photo, 'http') ? $doctor->photo : url("/storage/doctors/$doctor->photo") }}"
                                                        width="70" height="70" alt="{{ $doctor->name }}"></td>
                                                <td class="align-middle">{{ $doctor->sip }}</td>
                                                <td class="align-middle">{{ $doctor->id_ihs }}</td>
                                                <td class="align-middle">{{ $doctor->nik }}</td>
                                                <td class="align-middle">{{ $doctor->name }}</td>
                                                <td class="align-middle">{{ $doctor->specialization }}</td>
                                                <td class="align-middle">{{ $doctor->phone }}</td>
                                                <td class="align-middle">
                                                    <div class="d-flex">
                                                        <a href="{{ route('doctors.edit', $doctor->id) }}"
                                                            class="btn btn-icon btn-outline-dark mr-2">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                        <a href="" data-toggle="modal"
                                                            onclick="deleteDoctor('{{ $doctor->id }}')"
                                                            class="btn btn-icon btn-outline-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                {{ $doctors->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

{{-- Confirm Delete Modal --}}
<div class="modal fade" tabindex="-1" role="dialog" id="deleteDoctorModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Hapus data dokter dari database?</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <form action="{{ route('doctors.destroy', $doctor->id) }}" method="post" id="deleteDoctorForm">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-secondary">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Confirm Delete Modal --}}

{{-- Delete User Function --}}
<script>
    function deleteDoctor(id) {
        $('#deleteDoctorModal').modal('show');
        $('#deleteDoctorForm').attr('action', '/doctors/' + id)
        $('.delete').on('click', function() {});
    }
</script>
{{-- Delete User Function --}}

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
