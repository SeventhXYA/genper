@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Kelembagaan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Riwayat</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span class="badge bg-success card-title">
                            <h6>Riwayat Kegiatan</h6>
                        </span>
                        <a href="{{ url('/newkl') }}" class="badge bg-danger card-title">
                            <h6><i data-feather="plus" class="icon-sm"></i>
                                Tambah</h6>
                        </a>
                    </div>
                    <div class="table-responsive d-none d-md-inline">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th style="width:5rem;" rowspan="2"> Tgl Laporan </th>
                                    <th style="width:5rem;" rowspan="2"> Tgl Kegiatan </th>
                                    <th rowspan="2">Mulai</th>
                                    <th rowspan="2">Selesai</th>
                                    <th style="width:24rem;" rowspan="2"> Plan </th>
                                </tr>
                                <tr>
                                    <th> Progres </th>
                                    <th> Aksi </th>
                                </tr>
                            </thead>
                            @foreach ($dailykl as $kl)
                                <tbody>
                                    <tr>
                                        <td>{{ $kl->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $kl->tgl_kl }}</td>
                                        <td>{{ $kl->wkt_mulai }}</td>
                                        <td>{{ $kl->wkt_selesai }}</td>
                                        <td>{{ $kl->rencana }}</td>
                                        {{-- <td>{{ $kl->progres }}</td> --}}

                                        <td><span class="badge bg-success" style="width: 6rem">{{ $kl->progres }}%</span>
                                        </td>
                                        <td class="inline-flex">
                                            <button type="button" class="btn btn-inverse-success btn-xs"><i
                                                    data-feather="eye" class="icon-sm"></i></button>
                                            <a href="/historykl/edit/{{ $kl->id }}"
                                                class="btn btn-inverse-warning btn-xs {{ active_class(['historykl']) }}"><i
                                                    data-feather="edit" class="icon-sm"></i></a>
                                            {{-- <button type="button" class="btn btn-inverse-warning btn-xs"></button> --}}
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                    @foreach ($dailyklMobile as $kl)
                        <div class="d-inline d-md-none">
                            <div class="card my-2" style="border-width: 2px;">
                                <div class="card-header d-flex justify-content-between">
                                    <b>{{ $kl->created_at->format('Y-m-d') }}</b> <span class="badge bg-success my-auto"
                                        style="width: 6rem">{{ $kl->progres }}%</span>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="/historykl/edit/{{ $kl->id }}"
                                                class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="edit-2" class="icon-sm me-2"></i> <span
                                                    class="">Edit</span></a>
                                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                                    data-feather="trash" class="icon-sm me-2"></i> <span
                                                    class="">Delete</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="margin-top: -2rem">
                                    <?php
                                    $num_char = 50;
                                    $text = $kl->rencana;
                                    echo substr($text, 0, $num_char) . '...';
                                    ?>
                                </div>
                                <div class="card-footer d-flex justify-content-end" style="margin-top: -2rem">

                                    <button type="button" class="btn btn-inverse-secondary"><i data-feather="eye"
                                            class="icon-sm"></i></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $dailyklMobile->links() }}

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
