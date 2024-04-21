@extends('layouts.app')

@section('title', 'Layanan Klinik')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Layanan Klinik</h1>
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
                <h2 class="section-title">Layanan Klinik</h2>
                <p class="section-lead">Anda bisa mengelola semua layanan Klinik, seperti mengubah, menghapus dan yang
                    lainnya.</p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="section-header-button pl-4 pt-4">
                                <a href="{{ route('clinic-services.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    Tambah Layanan Klinik
                                </a>
                            </div>
                            <div class="card-header">
                                <h4>Data Layanan Klinik</h4>
                                <div class="card-header-form">
                                    <form>
                                        <div class="input-group d-flex align-items-center">
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Cari Layanan Klinik" value="{{ Request::get('name') }}">
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
                                @if (count($services) == 0)
                                    <div class="w-full d-flex p-0 justify-content-center align-items-center"
                                        style="height: 100px">
                                        <h5>Oopss, Data Layanan Klinik Kosong...</h5>
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table-bordered table-sm table-striped table-hover table">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>#</th>
                                                    <th>Nama</th>
                                                    <th>Kategori</th>
                                                    <th>Harga</th>
                                                    <th>Qty</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($services as $service)
                                                    <tr>
                                                        <td class="text-center align-middle">
                                                            {{ $loop->iteration }}</td>
                                                        <td class="align-middle">{{ $service->name }}</td>
                                                        <td class="align-middle">{{ $service->category }}</td>
                                                        <td class="align-middle">{{ $service->price }}</td>
                                                        <td class="align-middle">{{ $service->qty }}</td>
                                                        <td class="align-middle">
                                                            <div class="d-flex">
                                                                <a href="{{ route('clinic-services.edit', $service->id) }}"
                                                                    class="btn btn-icon btn-outline-dark mr-2">
                                                                    <i class="far fa-edit"></i>
                                                                </a>
                                                                <a href="" data-toggle="modal"
                                                                    onclick="deleteService('{{ $service->id }}')"
                                                                    class="btn btn-icon btn-outline-danger">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

{{-- Confirm Delete Modal --}}
<div class="modal fade" tabindex="-1" role="dialog" id="deleteServiceModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Hapus data layanan Klinik dari database?</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <form action="{{ route('doctors.destroy', $service->id ?? '') }}" method="post"
                    id="deleteServiceForm">
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
    function deleteService(id) {
        $('#deleteServiceModal').modal('show');
        $('#deleteServiceForm').attr('action', '/clinic-services/' + id)
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
