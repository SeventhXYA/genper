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
                        <a href="{{ url('/kgkoperasi/new') }}" type="button" class="btn btn-primary btn-icon-text mb-3">
                            <h6><i data-feather="plus" class="icon-sm"></i>
                                Tambah</h6>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th style="width:1rem;"> No </th>
                                    <th style="width:1rem;"> Tgl Laporan </th>
                                    <th>Kegiatan</th>
                                    <th>Pelaksana</th>
                                    <th style="width:1rem;"> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kgkoperasi as $kgk)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kgk->created_at->format('d-M-Y') }}</td>
                                        <td>
                                            <?php
                                            $num_char = 60;
                                            $text = $kgk->kegiatan;
                                            if (strlen($text) > $num_char) {
                                                $text = substr($text, 0, $num_char) . '...';
                                            }
                                            echo $text;
                                            ?>
                                        </td>
                                        <td>{{ $kgk->pelaksana }}</td>
                                        <td class="d-flex inline">
                                            <button type="button"
                                                class="btn btn-outline-secondary btn-xs btn-icon"data-bs-toggle="modal"
                                                data-bs-target="#viewModal-{{ $kgk->id }}"><i data-feather="eye"
                                                    class="icon-sm"></i></button>
                                            <a href="/kgkoperasi/edit/{{ $kgk->id }}"
                                                class="btn btn-outline-warning btn-xs btn-icon ms-2"><i data-feather="edit"
                                                    class="icon-sm"></i></a>
                                            <form name="delete" action="{{ route('kgkoperasi.delete', $kgk) }}"
                                                method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-xs btn-icon ms-2"
                                                    data-id="{{ $kgk->id }}"><i data-feather="trash"
                                                        class="icon-sm"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="viewModal-{{ $kgk->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                        {{ $kgk->created_at->format('d-M-Y') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="btn-close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col mb-3">
                                                        <label class="form-label fw-bold">Kegiatan</label>
                                                        <textarea class="form-control" maxlength="2500" rows="5" readonly style="background-color: #f5f5f5;">{{ $kgk->kegiatan }}</textarea>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label class="form-label fw-bold">Tanggal Pelaksanaan</label>
                                                        <input type="text" class="form-control"
                                                            value="@if ($kgk->end_date == null) {{ \Carbon\Carbon::parse($kgk->start_date)->format('d-M-Y') }}@else{{ \Carbon\Carbon::parse($kgk->start_date)->format('d') }} - {{ \Carbon\Carbon::parse($kgk->end_date)->format('d-M-Y') }} @endif"
                                                            readonly style="background-color: #f5f5f5;" />
                                                    </div>

                                                    <div class="col mb-3">
                                                        <label class="form-label fw-bold">Pelaksana</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $kgk->pelaksana }}" readonly
                                                            style="background-color: #f5f5f5;" />
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label class="form-label fw-bold">Jumlah</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $kgk->jumlah }}" readonly
                                                            style="background-color: #f5f5f5;" />
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label class="form-label fw-bold">Keterangan</label>
                                                        <textarea class="form-control" maxlength="2500" rows="5" readonly style="background-color: #f5f5f5;">{{ $kgk->keterangan }}</textarea>
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
