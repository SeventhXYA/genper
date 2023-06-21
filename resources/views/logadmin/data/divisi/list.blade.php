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
                        <button type="button" class="btn btn-primary btn-icon-text mb-3"data-bs-toggle="modal"
                            data-bs-target="#tambahModal"><i data-feather="plus" class="icon-sm"></i>
                            Tambah</button>
                        <div class="modal fade" id="tambahModal" tabindex="-1"
                            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">
                                            Tambah Divisi
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="btn-close"></button>
                                    </div>
                                    <form onsubmit="$('#submit').prop('disabled',true)" action="{{ route('divisi.store') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="col mb-3">
                                                <label class="form-label fw-bold">Divisi</label>
                                                <input type="text" class="form-control" name="divisi" autocomplete="off"
                                                    required />
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th style="width:1rem;"> # </th>
                                    <th> Divisi </th>
                                    <th style="width:1rem;"> Aksi </th>
                                    <th style="width:1rem;">Cek Akun Divisi </th>
                                    <th style="width:1rem;"> Hak Akses </th>
                                    <th style="width:1rem;"> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($divisi as $dv)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dv->divisi }}</td>

                                        <td class="d-flex inline">
                                            <button type="button"
                                                class="btn btn-outline-warning btn-xs btn-icon ms-2"data-bs-toggle="modal"
                                                data-bs-target="#editModal-{{ $dv->id }}"><i data-feather="edit"
                                                    class="icon-sm"></i></button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editModal-{{ $dv->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                                Ubah Divisi
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="btn-close"></button>
                                                        </div>
                                                        <form onsubmit="$('#submit').prop('disabled',true)"
                                                            action="/divisi/update/{{ $dv->id }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="col mb-3">
                                                                    <label class="form-label fw-bold">Divisi</label>
                                                                    <input type="text" class="form-control"
                                                                        name="divisi" value="{{ $dv->divisi }}"
                                                                        autocomplete="off" required />
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <form name="delete" action="{{ route('divisi.delete', $dv) }}"
                                                method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-xs btn-icon ms-2"
                                                    data-id="{{ $dv->id }}"><i data-feather="trash"
                                                        class="icon-sm"></i></button>
                                            </form>
                                        </td>
                                        <td class="text-center">
                                            @if ($dv->akundivisi_id)
                                                <span class="badge bg-success text-white">Memiliki Akun</span>
                                            @else
                                                <span class="badge bg-danger text-white">Tidak Memiliki Akun</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($dv->akundivisi_id)
                                                @if ($dv->akundivisi->id_level == 2)
                                                    <span class="badge bg-warning text-white">Divisi</span>
                                                @endif
                                            @else
                                                <span class="badge bg-danger text-white">Tidak Ada Data</span>
                                            @endif
                                        </td>
                                        <td class="d-flex inline">
                                            @if ($dv->akundivisi_id)
                                                <button type="button" class="btn btn-outline-secondary btn-icon btn-xs"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#detail-{{ $dv->akundivisi->id }}"><i
                                                        data-feather="eye" class="icon-sm"></i>
                                                </button>
                                                <div class="modal fade" id="detail-{{ $dv->akundivisi->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalScrollableTitle"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                                    Akun Divisi
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="btn-close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="col mb-3">
                                                                    <label class="form-label fw-bold">Divisi</label>
                                                                    <input type="text" class="form-control"
                                                                        name="divisi" value="{{ $dv->divisi }}"
                                                                        autocomplete="off" required readonly
                                                                        style="background-color: #f5f5f5" />
                                                                </div>
                                                                <div class="col mb-3">
                                                                    <label class="form-label fw-bold">Username</label>
                                                                    <input type="text" class="form-control"
                                                                        name="divisi"
                                                                        value="{{ $dv->akundivisi->username }}"
                                                                        autocomplete="off" required readonly
                                                                        style="background-color: #f5f5f5" />
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="/akundivisi/edit/{{ $dv->akundivisi->id }}"
                                                    class="btn btn-outline-warning btn-icon btn-xs mx-2"><i
                                                        data-feather="edit" class="icon-sm"></i></a>
                                                <form name="delete"
                                                    action="{{ route('akundivisi.delete', $dv->akundivisi) }}"
                                                    method="POST">
                                                    @method('delete') @csrf
                                                    <button type="submit"
                                                        class="btn btn-outline-danger btn-icon btn-xs"data-id="{{ $dv->akundivisi->id }}"><i
                                                            data-feather="trash" class="icon-sm"></i></button>
                                                </form>
                                            @else
                                                <a href="/akundivisi/add/{{ $dv->id }}"
                                                    class="btn btn-outline-primary btn-icon btn-xs me-2"><i
                                                        data-feather="plus" class="icon-sm"></i></a>
                                            @endif

                                        </td>
                                    </tr>
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
