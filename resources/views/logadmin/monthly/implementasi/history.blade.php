@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">{{ $title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $sub }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <a href="{{ url('/implementasi/new') }}" type="button" class="btn btn-primary btn-icon-text mb-3">
                            <h6><i data-feather="plus" class="icon-sm"></i>
                                Tambah</h6>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th style="width:1rem;"> # </th>
                                    <th style="width:1rem;"> Tgl Laporan </th>
                                    <th>Program</th>
                                    <th>Pelaksana</th>
                                    <th style="width:1rem;">RAB</th>
                                    <th style="width:1rem;">Keterangan</th>
                                    <th style="width:1rem;"> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($implementasi as $imp)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $imp->created_at->format('d-M-Y') }}</td>
                                        <td>{{ $imp->program }}</td>
                                        <td>{{ $imp->pelaksana }}</td>
                                        <td class="text-center">{{ $imp->rab }}</td>
                                        <td class="text-center">
                                            @if ($imp->keterangan == 0)
                                                <span class="badge bg-warning text-white">Progress</span>
                                            @elseif($imp->keterangan == 1)
                                                <span class="badge bg-success text-white">Completed</span>
                                            @elseif($imp->keterangan == 2)
                                                <span class="badge bg-danger text-white">Dana Dialihkan</span>
                                            @endif
                                        </td>

                                        <td class="d-flex inline">
                                            <button type="button"
                                                class="btn btn-outline-secondary btn-xs btn-icon"data-bs-toggle="modal"
                                                data-bs-target="#viewModal-{{ $imp->id }}"><i data-feather="eye"
                                                    class="icon-sm"></i></button>
                                            <a href="/implementasi/edit/{{ $imp->id }}"
                                                class="btn btn-outline-warning btn-xs btn-icon ms-2"><i data-feather="edit"
                                                    class="icon-sm"></i></a>
                                            <form name="delete" action="{{ route('implementasi.delete', $imp) }}"
                                                method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-xs btn-icon ms-2"
                                                    data-id="{{ $imp->id }}"><i data-feather="trash"
                                                        class="icon-sm"></i></button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="viewModal-{{ $imp->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                        {{ $imp->created_at->format('d-M-Y') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="btn-close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col mb-3">
                                                        <label for="defaultconfig-0" class="col-form-label">Program</label>
                                                        <textarea class="form-control" rows="3" autocomplete="off" readonly style="background-color: #f5f5f5;">{{ $imp->program }}</textarea>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label for="defaultconfig-2" class="col-form-label">Waktu
                                                            Kegiatan</label>
                                                        <input class="form-control"
                                                            value="@if ($imp->end_date) {{ $imp->start_date }} - {{ $imp->end_date }}@else{{ $imp->start_date }} @endif"
                                                            type="text" placeholder="0" autocomplete="off" readonly
                                                            style="background-color: #f5f5f5;">
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label for="defaultconfig-0"
                                                            class="col-form-label">Pelaksana</label>
                                                        <input class="form-control" value="{{ $imp->pelaksana }}"
                                                            type="text" placeholder="0" autocomplete="off" readonly
                                                            style="background-color: #f5f5f5;">
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label for="defaultconfig" class="col-form-label">Jumlah</label>
                                                        <input class="form-control" maxlength="255" name="jumlah"
                                                            style="width: 10%;background-color: #f5f5f5;" id="jumlah"
                                                            value="{{ $imp->jumlah }}" type="text" placeholder="0"
                                                            autocomplete="off" readonly>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label for="defaultconfig" class="col-form-label">Penerima
                                                            Manfaat</label>
                                                        <input class="form-control" maxlength="255"
                                                            name="penerima_manfaat"
                                                            style="width: 20%;background-color: #f5f5f5;"
                                                            id="penerima_manfaat" type="text"
                                                            value="{{ $imp->penerima_manfaat }}"placeholder=">0"
                                                            autocomplete="off" readonly>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label for="defaultconfig" class="col-form-label">RAB</label>
                                                        <input class="form-control" maxlength="255" name="rab"
                                                            style="width: 35%;background-color: #f5f5f5;" id="rab"
                                                            value="{{ $imp->rab }}" type="text"
                                                            autocomplete="off" readonly>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label for="defaultconfig"
                                                            class="col-form-label">Realisasi</label>
                                                        <input class="form-control" maxlength="255" name="rab"
                                                            style="width: 35%;background-color: #f5f5f5;" id="rab"
                                                            value="{{ $imp->realisasi }}" type="text"
                                                            autocomplete="off" readonly>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label for="defaultconfig"
                                                            class="col-form-label">Keterangan</label><br>
                                                        @if ($imp->keterangan == 0)
                                                            <span class="badge bg-warning text-white">Progress</span>
                                                        @elseif($imp->keterangan == 1)
                                                            <span class="badge bg-success text-white">Completed</span>
                                                        @elseif($imp->keterangan == 2)
                                                            <span class="badge bg-danger text-white">Dana Dialihkan</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script>
        @if (Session::has('success'))
            window.onload = () => showSwal('mixin', '{{ Session::get('success') }}')
        @endif

        document.querySelectorAll('form[name="delete"]').forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault()
                Swal.fire({
                    title: 'Apa anda yakin?',
                    text: "Setelah data dihapus, data tidak bisa dikembalikan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-primary me-3',
                        cancelButton: 'btn btn-label-secondary'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit()
                    }
                });
            });
        });
    </script>
@endpush
