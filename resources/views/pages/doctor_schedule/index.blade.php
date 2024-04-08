@extends('layouts.app')

@section('title', 'Jadwal Praktik')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Jadwal Praktik</h1>
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
                <h2 class="section-title">Jadwal Praktik</h2>
                <p class="section-lead">Anda bisa mengelola semua jadwal praktik, seperti mengubah, menghapus dan yang
                    lainnya.</p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="section-header-button pl-4 pt-4">
                                <a href="{{ route('schedules.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    Tambah Jadwal
                                </a>
                            </div>
                            <div class="card-header">
                                <h4>Data Jadwal Praktik</h4>
                                <div class="card-header-form">
                                    <form>
                                        <div class="input-group d-flex align-items-center">
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Cari Jadwal" value="{{ Request::get('name') }}">
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
                                @if (count($schedules) == 0)
                                    <div class="w-full d-flex p-0 justify-content-center align-items-center"
                                        style="height: 100px">
                                        <h5>Oopss, Data Jadwal Praktik Kosong...</h5>
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm table-hover table-striped">
                                            <thead>
                                                <tr class="text-center">
                                                    <th rowspan="2" class="align-middle">#</th>
                                                    <th rowspan="2" class="align-middle">SIP</th>
                                                    <th rowspan="2" class="align-middle">Dokter</th>
                                                    <th colspan="2" class="align-middle">Jadwal</th>
                                                    <th rowspan="2" class="align-middle">Status</th>
                                                    <th rowspan="2" class="align-middle">Note</th>
                                                    <th rowspan="2" class="align-middle"></th>
                                                </tr>
                                                <tr class="text-center">
                                                    <th>Hari</th>
                                                    <th>Jam</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($schedules as $schedule)
                                                    <tr>
                                                        <td class="text-center align-middle">
                                                            {{ $schedules->firstItem() + $loop->index }}</td>
                                                        <td class="align-middle text-center">
                                                            {{ $schedule->doctor_sip }}
                                                        </td>
                                                        <td class="align-middle">
                                                            {{ $schedule->doctor_name }},
                                                            {{ $schedule->doctor_specialization }}
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            {{ $schedule->day }}
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            {{ $schedule->start }} - {{ $schedule->end }}
                                                        </td>
                                                        <td class="text-center align-middle">
                                                            <div
                                                                class="badge badge-pill text-small @if ($schedule->status == 'Aktif') badge-success @else badge-danger @endif">
                                                                {{ $schedule->status }}
                                                            </div>
                                                        </td>
                                                        <td class="align-middle justify-content-center d-flex">
                                                            <button type="button" class="btn btn-outline-info"
                                                                data-container="body" data-toggle="popover"
                                                                data-placement="top" data-content="{{ $schedule->note }}"
                                                                data-trigger="focus">
                                                                <i class="fas fa-clipboard"></i>
                                                            </button>
                                                        </td>
                                                        <td class="align-middle">
                                                            <div class="d-flex justify-content-center">
                                                                <a href="{{ route('schedules.edit', $schedule->id) }}"
                                                                    class="btn btn-icon btn-outline-dark mr-2">
                                                                    <i class="far fa-edit"></i>
                                                                </a>
                                                                <a href="" data-toggle="modal"
                                                                    onclick="deleteDoctor('{{ $schedule->id }}')"
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
                            <div class="card-footer d-flex justify-content-end">
                                {{ $schedules->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

{{-- Confirm Delete Modal --}}
<div class="modal fade" tabindex="-1" role="dialog" id="deleteScheduleModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Hapus data jadwal dari database?</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <form action="{{ route('schedules.destroy', $schedule->id ?? '') }}" method="post"
                    id="deleteScheduleForm">
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
        $('#deleteScheduleModal').modal('show');
        $('#deleteScheduleForm').attr('action', '/schedules/' + id)
        $('.delete').on('click', function() {});
    }
</script>
{{-- Delete User Function --}}
