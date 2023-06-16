@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
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
                        <a href="{{ url('/monitoring/new') }}" type="button" class="btn btn-primary btn-icon-text mb-3">
                            <h6><i data-feather="plus" class="icon-sm"></i>
                                Tambah</h6>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table" style="width: 100%;">
                            <colgroup>
                                <col style="width: 1rem;">
                                <col style="width: 1rem;">
                                <col>
                                <col style="width: 1rem;">
                                <col style="width: 1rem;">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Tgl Laporan </th>
                                    <th>Program</th>
                                    <th>Keterangan</th>
                                    <th> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($monitoring as $mn)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $mn->created_at->format('d-M-Y') }}</td>
                                        <td>{{ $mn->program }}</td>
                                        <td class="text-center">
                                            @if ($mn->keterangan == 0)
                                                <span class="badge bg-warning text-white">Progress</span>
                                            @elseif($mn->keterangan == 1)
                                                <span class="badge bg-success text-white">Completed</span>
                                            @endif
                                        </td>

                                        <td class="d-flex inline">
                                            <button type="button"
                                                class="btn btn-outline-secondary btn-xs btn-icon"data-bs-toggle="modal"
                                                data-bs-target="#viewModal-{{ $mn->id }}"><i data-feather="eye"
                                                    class="icon-sm"></i></button>
                                            <a href="/monitoring/edit/{{ $mn->id }}"
                                                class="btn btn-outline-warning btn-xs btn-icon ms-2"><i data-feather="edit"
                                                    class="icon-sm"></i></a>
                                            <form name="delete" action="{{ route('monitoring.delete', $mn) }}"
                                                method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-xs btn-icon ms-2"
                                                    data-id="{{ $mn->id }}"><i data-feather="trash"
                                                        class="icon-sm"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="viewModal-{{ $mn->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                        {{ $mn->created_at->format('d-M-Y') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="btn-close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col mb-3">
                                                        <label class="form-label fw-bold">Program</label>
                                                        <textarea class="form-control" maxlength="2500" rows="5" readonly style="background-color: #f5f5f5;">{{ $mn->program }}</textarea>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label class="form-label fw-bold">Keterangan</label><br>
                                                        @if ($mn->keterangan == 0)
                                                            <span class="badge bg-warning text-white">Progress</span>
                                                        @elseif($mn->keterangan == 1)
                                                            <span class="badge bg-success text-white">Completed</span>
                                                        @endif
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label class="form-label fw-bold">Output</label>
                                                        <textarea class="form-control" maxlength="2500" rows="5" readonly style="background-color: #f5f5f5;">{{ $mn->output }}</textarea>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label class="form-label fw-bold">Outcome</label>
                                                        <textarea class="form-control" maxlength="2500" rows="5" readonly style="background-color: #f5f5f5;">{{ $mn->outcome }}</textarea>
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
