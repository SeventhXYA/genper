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
            <li class="breadcrumb-item"><a href="#">Inovasi & Creativity</a></li>
            <li class="breadcrumb-item active" aria-current="page">Riwayat</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <a href="{{ url('/inovasicreativity/newic') }}" type="button"
                            class="btn btn-primary btn-icon-text mb-3">
                            <h6><i data-feather="plus" class="icon-sm"></i>
                                Tambah</h6>
                        </a>
                    </div>
                    <div class="table-responsive d-none d-md-inline">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th style="width:1rem;"> Tgl Laporan </th>
                                    <th style="width:1rem;"> Tgl Kegiatan </th>
                                    <th style="width:1rem;">Mulai</th>
                                    <th style="width:1rem;">Selesai</th>
                                    <th> Plan </th>
                                    <th style="width:1rem;"> Progres </th>
                                    <th style="width:1rem;"> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dailyic as $ic)
                                    <tr>
                                        <td>{{ $ic->created_at->format('d-M-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($ic->tgl_ic)->format('d-M-Y') }}</td>
                                        <td>{{ $ic->wkt_mulai }}</td>
                                        <td>{{ $ic->wkt_selesai }}</td>
                                        <td><?php
                                        $num_char = 60;
                                        $text = $ic->rencana;
                                        if (strlen($text) > $num_char) {
                                            $text = substr($text, 0, $num_char) . '...';
                                        }
                                        echo $text;
                                        ?></td>
                                        {{-- <td>{{ $ic->progres }}</td> --}}

                                        <td><span class="badge bg-success" style="width: 6rem">{{ $ic->progres }}%</span>
                                        </td>
                                        <td class="d-flex inline">
                                            <button type="button"
                                                class="btn btn-outline-secondary btn-xs btn-icon"data-bs-toggle="modal"
                                                data-bs-target="#viewModal-{{ $ic->id }}"><i data-feather="eye"
                                                    class="icon-sm"></i></button>
                                            <a href="/inovasicreativity/edit/{{ $ic->id }}"
                                                class="btn btn-outline-warning btn-xs btn-icon ms-2"><i data-feather="edit"
                                                    class="icon-sm"></i></a>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="viewModal-{{ $ic->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                        {{ \Carbon\Carbon::parse($ic->tgl_ic)->format('d-M-Y') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="btn-close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col mb-3">
                                                        <label class="form-label fw-bold">Waktu Kegiatan</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $ic->wkt_mulai }} - {{ $ic->wkt_selesai }}" required
                                                            readonly style="background-color: #f5f5f5;" />
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label class="form-label fw-bold">Rencana</label>
                                                        <textarea class="form-control" maxlength="255" rows="8" readonly style="background-color: #f5f5f5;">{{ $ic->rencana }}</textarea>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label class="form-label fw-bold">Aktual</label>
                                                        <textarea class="form-control" maxlength="255" rows="8" readonly style="background-color: #f5f5f5;">{{ $ic->aktual }}</textarea>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label class="form-label fw-bold">Progres</label>
                                                        <span class="badge bg-success"
                                                            style="width: 100%">{{ $ic->progres }}%</span>
                                                        {{-- <input type="text" class="form-control" value="{{ $ic->progres }}"
                                                        required readonly style="background-color: white" /> --}}
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label class="form-label fw-bold">Foto</label>
                                                        <img src="{{ asset($ic->foto) }}" class="img-fluid" alt="">
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
                    @foreach ($dailyicMobile as $ic)
                        <div class="d-inline d-md-none">
                            <div class="card my-2" style="border-width: 2px;">
                                <div
                                    class="card-header d-flex justify-content-between"style="background-color: white; border:none">
                                    <b>{{ $ic->created_at->format('Y-m-d') }}</b> <span class="badge bg-success my-auto"
                                        style="width: 6rem">{{ $ic->progres }}%</span>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="/inovasicreativity/edit/{{ $ic->id }}"
                                                class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="edit-2" class="icon-sm me-2"></i> <span
                                                    class="">Edit</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="background-color: white; border:none">
                                    <?php
                                    $num_char = 60;
                                    $text = $ic->rencana;
                                    if (strlen($text) > $num_char) {
                                        $text = substr($text, 0, $num_char) . '...';
                                    }
                                    echo $text;
                                    ?>
                                </div>
                                <div class="card-footer d-flex justify-content-end"
                                    style="background-color: white; border:none">

                                    <button type="button" class="btn btn-outline-secondary"data-bs-toggle="modal"
                                        data-bs-target="#viewModalMobile-{{ $ic->id }}"><i data-feather="eye"
                                            class="icon-sm"></i></button>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="viewModalMobile-{{ $ic->id }}" tabindex="-1"
                            aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalScrollableTitle">
                                            {{ \Carbon\Carbon::parse($ic->tgl_ic)->format('d-M-Y') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="btn-close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Waktu Kegiatan</label>
                                            <input type="text" class="form-control"
                                                value="{{ $ic->wkt_mulai }} - {{ $ic->wkt_selesai }}" required readonly
                                                style="background-color: #f5f5f5;" />
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Rencana</label>
                                            <textarea class="form-control" maxlength="255" rows="8" readonly style="background-color: #f5f5f5;">{{ $ic->rencana }}</textarea>
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Aktual</label>
                                            <textarea class="form-control" maxlength="255" rows="8" readonly style="background-color: #f5f5f5;">{{ $ic->aktual }}</textarea>
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Progres</label>
                                            <span class="badge bg-success"
                                                style="width: 100%">{{ $ic->progres }}%</span>
                                            {{-- <input type="text" class="form-control" value="{{ $ic->progres }}"
                                            required readonly style="background-color: white" /> --}}
                                        </div>
                                        <div class="col mb-3">
                                            <label class="form-label fw-bold">Foto</label>
                                            <img src="{{ asset($ic->foto) }}" class="img-fluid" alt="">
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
                    {{ $dailyicMobile->links() }}

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
    </script>
@endpush
