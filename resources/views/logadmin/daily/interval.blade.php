@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Interval</a></li>
            <li class="breadcrumb-item active" aria-current="page">Riwayat Laporan</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive d-none d-md-inline">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th style="width:5rem;"> Tgl Laporan </th>
                                    <th>Nama</th>
                                    <th>Divisi</th>
                                    <th style="width:24rem;"> Interval </th>
                                    <th style="width:1rem;"> Aksi </th>
                                </tr>
                            </thead>
                            @foreach ($interval as $int)
                                <tbody>
                                    <tr>
                                        <td>{{ $int->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $int->user->nm_depan }} {{ $int->user->nm_belakang }}</td>
                                        <td>{{ $int->user->divisi->divisi }}</td>
                                        <td>
                                            <p class="d-flex justify-content-between">
                                                <span><i class="mdi mdi-book-open-page-variant"></i>
                                                    Self-Development:</span>
                                                <span>{{ gmdate('H:i:s', $int->user->totalSd) }}<b> /01:00:00</b></span>
                                            </p>
                                            <div class="progress">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: {{ $int->user->percentageSd }}%" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <p class="d-flex justify-content-between">
                                                <span><i class="mdi mdi-chart-areaspline"></i> Bisnis & Profit:</span>
                                                <span>{{ gmdate('H:i:s', $int->user->totalBp) }}<b> /04:00:00</b></span>
                                            </p>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ $int->user->percentageBp }}%" aria-valuenow="50"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="d-flex justify-content-between">
                                                <span><i class="mdi mdi-bank"></i> Kelembagaan:</span>
                                                <span>{{ gmdate('H:i:s', $int->user->totalKl) }}<b> /00:30:00</b></span>
                                            </p>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: {{ $int->user->percentageKl }}%" aria-valuenow="75"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="d-flex justify-content-between">
                                                <span><i class="mdi mdi-brush"></i> Inovasi & Creativity:</span>
                                                <span>{{ gmdate('H:i:s', $int->user->totalIc) }}<b> /00:30:00</b></span>
                                            </p>
                                            <div class="progress">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: {{ $int->user->percentageIc }}%" aria-valuenow="100"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class="d-flex inline">
                                            {{-- <button type="button"
                                                class="btn btn-inverse-secondary btn-xs btn-icon"data-bs-toggle="modal"
                                                data-bs-target="#viewModal-{{ $int->id }}"><i data-feather="eye"
                                                    class="icon-sm"></i></button> --}}
                                            <form name="delete" action="{{ route('interval.delete', $int) }}"
                                                method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-inverse-danger btn-xs btn-icon ms-2"
                                                    data-id="{{ $int->id }}"><i data-feather="trash"
                                                        class="icon-sm"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- Modal -->
                                <div class="modal fade" id="viewModal-{{ $int->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                    {{ $int->tgl_int }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="btn-close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">{{ $int->user->nm_depan }}
                                                        {{ $int->user->nm_belakang }}</label> <br>
                                                    {{ $int->user->divisi->divisi }} <br>
                                                    {{ $int->user->nohp }} <br>
                                                    {{ $int->user->email }}
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Waktu Kegiatan</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $int->wkt_mulai }} - {{ $int->wkt_selesai }}" required
                                                        readonly style="background-color: #f5f5f5" />
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Rencana</label>
                                                    <textarea class="form-control" maxlength="255" rows="7" readonly style="background-color: #f5f5f5;">{{ $int->rencana }}</textarea>
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Aktual</label>
                                                    <textarea class="form-control" maxlength="255" rows="7" readonly style="background-color: #f5f5f5;">{{ $int->aktual }}</textarea>
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Progres</label>
                                                    <span class="badge bg-success"
                                                        style="width: 100%">{{ $int->progres }}%</span>
                                                </div>
                                                <div class="col mb-3">
                                                    <label class="form-label fw-bold">Foto</label>
                                                    <img src="{{ asset($int->foto) }}" class="img-fluid" alt="">
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
                        </table>
                    </div>
                    @foreach ($intervalMobile as $int)
                        <div class="d-inline d-md-none">
                            <div class="card my-2" style="border-width: 2px;">
                                <div
                                    class="card-header d-flex justify-content-between"style="background-color: white; border:none">
                                    <b>{{ $int->created_at->format('Y-m-d') }}</b> <span class="badge bg-success my-auto"
                                        style="width: 6rem">{{ $int->progres }}%</span>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="/historyint/edit/{{ $int->id }}"
                                                class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="trash" class="icon-sm me-2"></i> <span
                                                    class="">Delete</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="background-color: white; border:none">
                                    <label class="form-label fw-bold">{{ $int->user->nm_depan }}
                                        {{ $int->user->nm_belakang }}</label><br>
                                    {{ $int->user->divisi->divisi }} <br> <br>
                                    <?php
                                    $num_char = 30;
                                    $text = $int->rencana;
                                    echo substr($text, 0, $num_char) . '...';
                                    ?>
                                </div>
                                <div class="card-footer d-flex justify-content-end"
                                    style="background-color: white; border:none">

                                    <button type="button"
                                        class="btn btn-inverse-secondary btn-icon btn-xl"data-bs-toggle="modal"
                                        data-bs-target="#viewModalMobile-{{ $int->id }}"><i data-feather="eye"
                                            class="icon-xl"></i></button>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="viewModalMobile-{{ $int->id }}" tabindex="-1"
                            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">
                                            {{ $int->tgl_int }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="btn-close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">{{ $int->user->nm_depan }}
                                                {{ $int->user->nm_belakang }}</label> <br>
                                            {{ $int->user->divisi->divisi }} <br>
                                            {{ $int->user->nohp }} <br>
                                            {{ $int->user->email }}
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Waktu Kegiatan</label>
                                            <input type="text" class="form-control"
                                                value="{{ $int->wkt_mulai }} - {{ $int->wkt_selesai }}" required readonly
                                                style="background-color: #f5f5f5" />
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Rencana</label>
                                            <textarea class="form-control" maxlength="255" rows="7" readonly style="background-color: #f5f5f5;">{{ $int->rencana }}</textarea>
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Aktual</label>
                                            <textarea class="form-control" maxlength="255" rows="7" readonly style="background-color: #f5f5f5;">{{ $int->aktual }}</textarea>
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Progres</label>
                                            <span class="badge bg-success"
                                                style="width: 100%">{{ $int->progres }}%</span>
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Foto</label>
                                            <img src="{{ asset($int->foto) }}" class="img-fluid" alt="">
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
                    {{ $intervalMobile->links() }}

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
